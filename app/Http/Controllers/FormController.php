<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormModel;
use App\Models\RocnikyModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmittedMail;

class FormController extends Controller
{
    public function handleFormSubmission(Request $request){
        
        // $formData = $this->store($request);

        $client = $this->getGoogleClient();
        $driveService = new Drive($client);

        $fileMetaData = new DriveFile([
            'name' => 'template',
            'parents' => [env('GOOGLE_DRIVE_FOLDER_ID')],
            'mimeType' => 'application/vnd.google-apps.document'
        ]);

        $content = file_get_contents(resource_path('templates/Posudek_I_beh.docx'));
        $uploadedFile = $driveService->files->create($fileMetaData, [
            'data' => $content,
            'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'uploadType' => 'multipart',
            'fields' => 'id',
        ]);

        $fileId = $uploadedFile->getId();
        $response = $driveService->files->export($fileId, 'application/pdf', [
            'alt' => 'media',
        ]);

        // Save the PDF to the desired location
        $destinationPath = storage_path('app/public/template.pdf');
        file_put_contents($destinationPath, $response->getBody());

        // Hodnoty z tabulky Rocniky
        // $rocnik = $this->show('2024');
        // $rok = $rocnik->rok;
        // $termin = $rocnik->termin;
        // $cena = $rocnik->cena;

        //  // Templaty  file paths
        // $templates = [
        //     resource_path('templates/Přihláška_I_beh.docx'),
        //     resource_path('templates/Posudek_I_beh.docx'),
        //     resource_path('templates/List_účastníka_I_beh.docx'),
        // ];

        // // Process each template
        // foreach ($templates as $template) {
        //     $templateName = explode('/', $template);
        //     $templateName = end($templateName);
        //     $templateName = explode('.', $templateName)[0];

        //     // Generate Word document
        //     $wordPath = $this->generateWordDocument($template, $templateName, $formData, $rok, $termin, $cena);

        //     // $pdfPaths[] = $this->convertToPdf($wordPath, $formData, $templateName, $rok);
        // }

        // // $pdf = $this->fillPdf("test");

        // $message_valid = 'Formulář byl úspěšně odeslán.';

        // // Mail::to($formData->parent_email)->send(new FormSubmittedMail($formData, $pdfPaths, $rocnik));

        // return redirect()->back()->with('success', $message_valid);
    }

    public function store(Request $request)
    { 
        // Names in forms
        $validatedData = $request->validate([
            'parent_email' => 'required|email',
            'parent_names' => 'required|string|max:255',
            'parent_number' => 'required|string|max:20',
            'parent_street' => 'required|string|max:255',
            'parent_city' => 'required|string|max:255',
            'parent_zip' => 'required|string|max:20',
            'parent_note' => 'nullable|string',
            'child_first_name' => 'required|string|max:255',
            'child_last_name' => 'required|string|max:255',
            'child_birthday' => 'required|date',
            'child_street' => 'required|string|max:255',
            'child_city' => 'required|string|max:255',
            'child_zip' => 'required|string|max:20',
            'misto_nastupu' => 'required|string|max:255',
            'plavec' => 'required|string|max:3',
            'velikost_trika' => 'required|string|max:3',
            'child_note' => 'required|string',
            'photos_agreement' => 'required|string|max:3',
            'facture' => 'required|string|max:3',
        ]);

        $validatedData['child_birthday'] = Carbon::createFromFormat('Y-m-d', $validatedData['child_birthday'])->format('d/m/Y');
        
        if ($validatedData['misto_nastupu'] === "Jiné") {
            $validatedData['misto_nastupu'] = $request->input('misto_nastupu_custom');
            $request->validate([
                'misto_nastupu_custom' => 'required|string|max:255'
            ]);
        }

        // Uložení do databáze
        $formdata = FormModel::create($validatedData);

        // Uložení VS do databáze
        $year = Carbon::now()->format('Y');
        $idPart = str_pad($formdata->id % 1000, 3, '0', STR_PAD_LEFT);
        $formdata->variable_symbol = $year . '01' . $idPart;
        $formdata->save();

        return $formdata;
    }
    public function show($value)
    {
        // Retrieve the row where a specific column matches the given value
        $rocnik = RocnikyModel::where('rok', $value)->first();
        
        return $rocnik;
    }

    public function generateWordDocument($templatePath, $templateName, $formData, $rok, $termin, $cena)
    {
        $outputPath = storage_path("app/public/2025/K{$rok}_{$templateName}_{$formData->child_first_name}_{$formData->child_last_name}.docx");

        $templateProcessor = new TemplateProcessor($templatePath);
        $templateProcessor->setValue('VAR_SYM', $formData->variable_symbol);
        $templateProcessor->setValue('EMAIL', $formData->parent_email);
        $templateProcessor->setValue('RODIC', $formData->parent_names);
        $templateProcessor->setValue('TELEFON', $formData->parent_number);
        $templateProcessor->setValue('RODIC_ULICE', $formData->parent_street);
        $templateProcessor->setValue('RODIC_OBEC', $formData->parent_city);
        $templateProcessor->setValue('RODIC_PSC', $formData->parent_zip);
        $templateProcessor->setValue('DITE_JMENO', $formData->child_first_name);
        $templateProcessor->setValue('DITE_PRIJMENI', $formData->child_last_name);
        $templateProcessor->setValue('DITE_DATUM_NAROZENI', $formData->child_birthday);
        $templateProcessor->setValue('DITE_ULICE', $formData->child_street);
        $templateProcessor->setValue('DITE_OBEC', $formData->child_city);
        $templateProcessor->setValue('DITE_PSC', $formData->child_zip);
        $templateProcessor->setValue('DITE_POZNAMKA', $formData->child_note);
        $templateProcessor->setValue('ROK', $rok);
        $templateProcessor->setValue('TERMIN', $termin);
        $templateProcessor->setValue('ZACATEK', explode(' - ',$termin)[0]);
        $templateProcessor->setValue('CENA', $cena);

        $templateProcessor->saveAs($outputPath);

        return $outputPath;
    }

    private function getGoogleClient() {
        $client = new Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->setAccessType('offline');
       
        $refreshToken = env('GOOGLE_DRIVE_REFRESH_TOKEN');

        // Validate that the refresh token exists
        if (empty($refreshToken)) {
            throw new \Exception("Refresh token is missing in .env file.");
        }
    
        // Set a dummy token structure to include the refresh token
        $client->setAccessToken([
            'access_token' => '', // Dummy value, will be refreshed
            'expires_in' => 0,   // Expired dummy value
            'refresh_token' => $refreshToken,
        ]);
    
        // Refresh the token if it is expired
        if ($client->isAccessTokenExpired()) {
            $newToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
    
            // Check if token fetch was successful
            if (isset($newToken['error'])) {
                throw new \Exception("Failed to refresh token: " . $newToken['error_description']);
            }
    
            $client->setAccessToken($newToken);
        }
    
        return $client;
    }

    public function token()
    {
        $client_id = \Config('services.google.client_id');
        $client_secret = \Config('services.google.client_secret');
        $refresh_token = \Config('services.google.refresh_token');
        $folder_id = \Config('services.google.folder_id');

        $response = Http::post('https://oauth2.googleapis.com/token', [

            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'refresh_token' => $refresh_token,
            'grant_type' => 'refresh_token',

        ]);
        //dd($response);
        $responseData = json_decode((string) $response->getBody(), true);

        if (isset($responseData['access_token'])) {
            return $responseData['access_token'];
        }
    }
}
