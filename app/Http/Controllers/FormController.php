<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormModel;
use App\Models\RocnikyModel;
use Illuminate\Support\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmittedMail;

class FormController extends Controller
{
    public function handleFormSubmission(Request $request){
        $formData = $this->store($request);

        // Hodnoty z tabulky Rocniky
        $rocnik = $this->show('2024');
        $rok = $rocnik->rok;
        $termin = $rocnik->termin;
        $cena = $rocnik->cena;

         // Templaty  file paths
        $templates = [
            resource_path('templates/Přihláška_I_beh.docx'),
            resource_path('templates/Posudek_I_beh.docx'),
            resource_path('templates/List_účastníka_I_beh.docx'),
        ];

        // Process each template
        foreach ($templates as $template) {
            $templateName = explode('/', $template);
            $templateName = end($templateName);
            $templateName = explode('.', $templateName)[0];

            // Generate Word document
            $wordPath = $this->generateWordDocument($template, $templateName, $formData, $rok, $termin, $cena);

            $pdfPaths[] = $this->convertToPdf($wordPath, $formData, $templateName, $rok);
        }

        $message_valid = 'Formulář byl úspěšně odeslán.';

        Mail::to($formData->parent_email)->send(new FormSubmittedMail($formData, $pdfPaths, $rocnik));

        return redirect()->back()->with('success', $message_valid);
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

    public function convertToPdf($wordFilePath, $formData, $templateName, $rok)
    {
        // Set PDF rendering library
        Settings::setPdfRendererName(Settings::PDF_RENDERER_TCPDF);
        Settings::setPdfRendererPath(base_path('vendor/tecnickcom/tcpdf'));
        
        // Load the Word file
        $phpWord = IOFactory::load($wordFilePath);
        $phpWord->setDefaultFontName('DejaVu Sans');

        $pdfFilePath = storage_path("app/public/2025/K{$rok}_{$templateName}_{$formData->child_first_name}_{$formData->child_last_name}.pdf");

        $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
        $pdfWriter->save($pdfFilePath);

        return $pdfFilePath;
    }
}
