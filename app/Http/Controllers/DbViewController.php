<?php

namespace App\Http\Controllers;

use App\Models\FormModel;
use Illuminate\Http\Request;
use App\Models\RocnikyModel;

class DbViewController extends Controller
{
    public function showPrihlaskyDb() {
        $data = FormModel::all();
        return view('prihlasky-private', ["prihlasky"=>$data]);
    }
}
