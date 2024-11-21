<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormModel;
use Illuminate\Support\Carbon;

class FormController extends Controller
{
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
        $form = FormModel::create($validatedData);

        // Uložení VS do databáze
        $year = Carbon::now()->format('Y');
        $idPart = str_pad($form->id % 1000, 3, '0', STR_PAD_LEFT);
        $form->variable_symbol = $year . '01' . $idPart;
        $form->save();
    }
}
