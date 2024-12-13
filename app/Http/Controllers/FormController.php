<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormModel;
use App\Models\RocnikyModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmittedMail;
use App\Jobs\ProcessFormSubmission;


class FormController extends Controller
{
    public function handleFormSubmission(Request $request){
        
        // 1. Uložení do databáze
        $formData = $this->storeToDb($request);

        // 2. Hodnoty z tabulky databáze Rocniky
        $rocnik = $this->getRocnikFromDb();

        // 3. Složky
        $folderNamePatient = "{$formData->child_first_name}_{$formData->child_last_name}";
        
        // Ensure the directories exist
        if (!File::exists(storage_path("app/public/{$rocnik->rok}/{$folderNamePatient}"))) {
            File::makeDirectory(storage_path("app/public/{$rocnik->rok}/{$folderNamePatient}"), 0755, true); // Create directories recursively
        }
        
        $folderPathPatient = storage_path("app/public/{$rocnik->rok}/{$folderNamePatient}"); // Full path to the folder

        // 4. Word vyplnění a uložení lokálně
        $wordPaths = $this->storeWordDoc($formData, $folderPathPatient, $rocnik);

        // 5 Odeslání na drive, uložení lokálně a zaslání emailu
        ProcessFormSubmission::dispatch($formData, $wordPaths, $folderPathPatient, $rocnik);

        // 5.1 Odeslání na drive a uložení lokálně
        // $pdfPaths = $this->storePdfsToDrive($wordPaths, $folderPathPatient);

        // 5.2 Email
        // Mail::to($formData->parent_email)->send(new FormSubmittedMail($formData, $pdfPaths, $rocnik));

        // 6. Návrat na stránku
        $messageValid = 'Formulář byl úspěšně odeslán.';
        return redirect()->back()->with('success-prihlaska', $messageValid);
    }

    public function storeToDb(Request $request)
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
        // $year = Carbon::now()->format('Y');
        $year = $this->getRocnikFromDb()->rok;
        $idPart = str_pad($formdata->id % 1000, 3, '0', STR_PAD_LEFT);
        $formdata->variable_symbol = $year . '01' . $idPart;
        $formdata->save();

        return $formdata;
    }

    public function getRocnikFromDb()
    {
        // Retrieve the row where a specific column matches the given value
        $rocnik = RocnikyModel::orderBy('ID', 'desc')->first();
        
        return $rocnik;
    }

    public function generateWordDocument($folderPathPatient, $wordDocumentName, $templatePath, $formData, $rocnik)
    {
        $outputPath = "{$folderPathPatient}/{$wordDocumentName}.docx";

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
        $templateProcessor->setValue('ROK', $rocnik->rok);
        $templateProcessor->setValue('TERMIN', $rocnik->termin);
        $templateProcessor->setValue('ZACATEK', explode(' - ',$rocnik->termin)[0]);
        $templateProcessor->setValue('CENA', $rocnik->cena);

        $templateProcessor->saveAs($outputPath);

        return $outputPath;
    }

    private function storeWordDoc($formData, $folderPathPatient, $rocnik) {
        $dirTemplates = resource_path('templates');

        // Get all DOCX files from the dirTemplates
        $templates = collect(File::files($dirTemplates))
            ->filter(fn($file) => $file->getExtension() === 'docx')
            ->map(fn($file) => $file->getPathname())
            ->values()
            ->toArray();
        
        // Process each template
        foreach ($templates as $template) {
            $templateName = basename($template, '.docx');
            $wordDocumentName = "K{$rocnik->rok}_{$templateName}_{$formData->child_first_name}_{$formData->child_last_name}";

            // Generate Word document
            $wordPaths[] = $this->generateWordDocument($folderPathPatient, $wordDocumentName,$template, $formData, $rocnik);
        }
        return $wordPaths;
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

    private function storePdfsToDrive($wordPaths, $folderPathPatient){
        $client = $this->getGoogleClient();
        $driveService = new Drive($client);

        $index = 0;

        // Process each PDF
        foreach ($wordPaths as $wordpath) {
            
            $wordDocumentBaseName = basename($wordpath,'.docx');

            // Step 1: Upload Word document to Google Drive and convert it to Google Docs
            $fileMetaData = new DriveFile([
                'name' => $wordDocumentBaseName,
                'parents' => [env('GOOGLE_DRIVE_FOLDER_ID')],
                'mimeType' => 'application/vnd.google-apps.document'
            ]);
    
            $content = file_get_contents($wordPaths[$index]);
            $uploadedFile = $driveService->files->create($fileMetaData, [
                'data' => $content,
                'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'uploadType' => 'multipart',
                'fields' => 'id',
            ]);
    
            $fileId = $uploadedFile->getId();

            // Step 2: Export the file as a PDF
            $response = $driveService->files->export($fileId, 'application/pdf', [
                'alt' => 'media',
            ]);
    
            // Step 3: Save the PDF file locally
            $destinationPath = "{$folderPathPatient}/$wordDocumentBaseName.pdf";
            file_put_contents($destinationPath, $response->getBody());
            $pdfPaths[] = $destinationPath;
            $index++;
        }

        return $pdfPaths;
    }
}
