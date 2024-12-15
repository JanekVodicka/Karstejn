<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmittedMail;
use App\Models\PrihlaskyFrontaModel;
use App\Models\FormModel;
use App\Models\RocnikyModel;
use Google\Client;
use Google\Service\Drive;
use phpseclib3\Crypt\RC2;

class PrihlaskyFrontaController extends Controller
{

    protected $formData;
    protected $wordPaths;
    protected $folderPathPatient;
    protected $rocnik;


    public function cronRunJob(){
        
        $prihlaskyVeFronteData = PrihlaskyFrontaModel::where('zprocesovano',0)->get();

        foreach($prihlaskyVeFronteData as $prihlaska) {
            $formData = json_decode($prihlaska->formData, true);
            $wordPaths = json_decode($prihlaska->wordPaths, true);
            $folderPathPatient = $prihlaska->folderPathPatient;
            $rocnik = json_decode($prihlaska->rocnik, true);

            // Create an instance of the model and fill it
            $formModel = new FormModel();
            $formModel->fill($formData);

            $rocnik = (object) $rocnik;

            $pdfPaths = $this->storePdfsToDrive($wordPaths, $folderPathPatient);
            Mail::to($formModel->parent_email)->send(new FormSubmittedMail($formModel, $pdfPaths, $rocnik));

            $prihlaska->zprocesovano = 1;
            $prihlaska->save();   
        }
    }

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
