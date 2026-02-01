<?php

namespace App\Jobs;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\FormSubmittedMail;
use Illuminate\Support\Facades\Mail;

class ProcessFormSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $formData;
    protected $wordPaths;
    protected $folderPathPatient;
    protected $rocnik;
    
    /**
     * Create a new job instance.
     */
    public function __construct($formData, $wordPaths, $folderPathPatient, $rocnik)
    {
        $this->formData = $formData;
        $this->wordPaths = $wordPaths;
        $this->folderPathPatient = $folderPathPatient;
        $this->rocnik = $rocnik;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Důležité: cron a CLI musí mít správnou timezone
        date_default_timezone_set('UTC');

        $pdfPaths = $this->storePdfsToDrive($this->wordPaths, $this->folderPathPatient);

        Mail::to($this->formData->parent_email)->send(new FormSubmittedMail($this->formData, $pdfPaths, $this->rocnik));
    }

    private function getGoogleClient()
    {
        $jsonPath = storage_path('app/google/service-account.json');

        if (!file_exists($jsonPath)) {
            throw new \Exception("Google service account JSON not found: {$jsonPath}");
        }

        $client = new Client();
        $client->setAuthConfig($jsonPath);
        $client->addScope([
            Drive::DRIVE,
            'https://www.googleapis.com/auth/documents',
        ]);

        return $client;
    }

    private function storePdfsToDrive($wordPaths, $folderPathPatient)
    {
        $client = $this->getGoogleClient();
        $driveService = new Drive($client);
        $pdfPaths = [];

        foreach ($wordPaths as $wordPath) {
            $wordDocumentBaseName = pathinfo($wordPath, PATHINFO_FILENAME);

            // Upload Word document
            $fileMetaData = new DriveFile([
                'name' => $wordDocumentBaseName,
                'parents' => [env('GOOGLE_DRIVE_FOLDER_ID')],
                'mimeType' => 'application/vnd.google-apps.document',
            ]);

            $content = file_get_contents($wordPath);
            $uploadedFile = $driveService->files->create($fileMetaData, [
                'data' => $content,
                'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'uploadType' => 'multipart',
                'fields' => 'id',
            ]);

            $fileId = $uploadedFile->getId();

            // Export as PDF
            $response = $driveService->files->export($fileId, 'application/pdf', [
                'alt' => 'media',
            ]);

            $destinationPath = "{$folderPathPatient}/{$wordDocumentBaseName}.pdf";
            file_put_contents($destinationPath, $response->getBody()->getContents());
            $pdfPaths[] = $destinationPath;
        }

        return $pdfPaths;
    }
}
