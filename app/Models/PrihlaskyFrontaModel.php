<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrihlaskyFrontaModel extends Model
{
    protected $table = 'nezpracovane_prihlasky';

    protected $fillable = [
        'formData',
        'wordPaths',
        'folderPathPatient',
        'rocnik',
    ];
}
