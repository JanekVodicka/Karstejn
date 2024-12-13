<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RocnikyModel;

class IndexController extends Controller
{
    public function showToIndex()
    {
        $data_rocniky = RocnikyModel::select('rok', 'zobrazit_v_info')
            ->where('zobrazit_v_info', 'ano')
            ->orderBy('id', 'desc')
            ->first(); // Get only the last row
        
        $data_rocniky_array = $data_rocniky ? $data_rocniky->toArray() : [];

        return view("index", ['data_rocniky' => $data_rocniky_array]);
    }
}
