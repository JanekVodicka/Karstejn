<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RocnikyModel;
use App\Models\SettingsModel;

class InfoController extends Controller
{
    public function showToInfo()
    {
        $data_rocniky = RocnikyModel::select('rok', 'cena', 'tema_1beh', 'termin_1beh', 'tema_2beh', 'termin_2beh', 'zobrazit_v_info')
            ->where('zobrazit_v_info', 'ano')
            ->orderBy('id', 'desc')
            ->first(); // Get only the last row
        
        $data_rocniky_array = $data_rocniky ? $data_rocniky->toArray() : [];

        $spusteni_prihlasek = SettingsModel::where('typ_nastaveni','Spuštění přihlášek - 1.běh')->value('hodnota_nastaveni');

        $aktivace_prihlasek_2beh = SettingsModel::where('typ_nastaveni','Aktivace přihlášek - 2. běh')->value('hodnota_nastaveni');

        return view("info", ['data_rocniky' => $data_rocniky_array, 'spusteni_prihlasek' => $spusteni_prihlasek, 'aktivace_prihlasek_2beh' =>  $aktivace_prihlasek_2beh]);
    }
}