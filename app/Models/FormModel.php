<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormModel extends Model
{
    // Zde určím, do jaké tabulky v db se data uloží
    protected $table = 'prihlasky';
    // Zde určím, do jakých polí se bude ukládat když použiju From::
    protected $fillable = [
        'id',
        'variable_symbol',
        'parent_email',
        'parent_names',
        'parent_number',
        'parent_street',
        'parent_city',
        'parent_zip',
        'parent_note',
        'child_first_name',
        'child_last_name',
        'child_birthday',
        'child_street',
        'child_city',
        'child_zip',
        'misto_nastupu',
        'plavec',
        'velikost_trika',
        'specialista',
        'child_note',
        'photos_agreement',
        'facture',
        'created_at',
        'updated_at',
    ];
}
