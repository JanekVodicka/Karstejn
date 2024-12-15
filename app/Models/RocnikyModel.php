<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RocnikyModel extends Model
{
    protected $table = 'rocniky';
    protected $fillable = [
        'id',
        'rok',
        'cena',
        'termin_1beh',
        'tema_1beh',
        'termin_2beh',
        'tema_2beh',
        'zobrazit_v_galerii',
        'zobrazit_v_info',
    ];
}
