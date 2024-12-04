<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RocnikyModel;

class InfoController extends Controller
{
    public function showToInfo()
    {
        $data_rocniky = RocnikyModel::select('rok', 'cena', 'tema_1beh', 'termin_1beh', 'tema_2beh', 'termin_2beh')
            ->orderBy('id', 'desc')
            ->first(); // Get only the last row
        
        $data_rocniky_array = $data_rocniky ? $data_rocniky->toArray() : [];

        return view("info", ['data_rocniky' => $data_rocniky_array]);
    }
}
