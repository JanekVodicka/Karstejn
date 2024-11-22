<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormModel;
use App\Models\RocnikyModel;
use Illuminate\Support\Carbon;

class FormController extends Controller
{
    public function handleFormSubmission(Request $request){
        $this->store($request);

        // Hodnoty z tabulky Rocniky
        $rocnik = $this->show('2024');
        $rok = $rocnik->rok;
        $termin = $rocnik->termin;
        $cena = $rocnik->cena;

         // Templaty  file paths
        $templates = [
            resource_path('templates/K{{ROK}}_Přihláška_{{DITE}}_I_beh.docx'),
            resource_path('templates/K{{ROK}}_Posudek_{{DITE}}_I_beh.docx'),
            resource_path('templates/K{{ROK}}_List_účastníka_{{DITE}}_I_beh..docx'),
        ];

        $message_valid = 'Formulář byl úspěšně odeslán.';

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
}
