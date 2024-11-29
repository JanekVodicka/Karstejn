<?php

namespace App\Jobs;

use Google\Client;
use Google\Service\Drive;
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
        $pdfPaths = $this->storePdfsToDrive($this->wordPaths, $this->folderPathPatient);

        Mail::to($this->formData->parent_email)->send(new FormSubmittedMail($this->formData, $pdfPaths, $this->rocnik));
    }

    private function getGoogleClient()
    {
        $client = new Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->setAccessType('offline');
        $client->setAccessToken([
            'access_token' => '',
            'expires_in' => 0,
            'refresh_token' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
        ]);

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));
        }

        return $client;
    }

    private function storePdfsToDrive($wordPaths, $folderPathPatient)
    {
        $client = $this->getGoogleClient();
        $driveService = new Drive($client);
        $pdfPaths = [];

        foreach ($wordPaths as $wordPath) {
            $wordDocumentBaseName = basename($wordPath, '.docx');

            // Upload Word document
            $fileMetaData = new Drive\DriveFile([
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
            file_put_contents($destinationPath, $response->getBody());
            $pdfPaths[] = $destinationPath;
        }

        return $pdfPaths;
    }
}
