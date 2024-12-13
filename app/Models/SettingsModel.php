<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'typ_nastaveni',
        'hodnota_nastaveni',
    ];
}
