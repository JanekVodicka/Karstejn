<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingsModel;

class SettingsController extends Controller
{
    public function getValueFromSettingsToPrihlaska() {
        $spusteni_prihlasek = SettingsModel::where('typ_nastaveni','Spuštění přihlášek - 1.běh')->value('hodnota_nastaveni');

        return view('prihlaska', ['spusteni_prihlasek' => $spusteni_prihlasek]);
    }

    public function getValueFromSettingsToSettings() {
        $spusteni_prihlasek = SettingsModel::where('typ_nastaveni','Spuštění přihlášek - 1.běh')->value('hodnota_nastaveni');

        $aktivace_prihlasek_2beh = SettingsModel::where('typ_nastaveni','Aktivace přihlášek - 2. běh')->value('hodnota_nastaveni');

        // $obsahNastaveni = SettingsModel::all()->toArray();

        return view('settings', ['spusteni_prihlasek' => $spusteni_prihlasek, 'aktivace_prihlasek_2beh' =>  $aktivace_prihlasek_2beh]);
    }

    public function saveSettings(Request $request) {

        $valueSpustitPrihlasky = $request->has('spustit_prihlasku') ? 'ano' : 'ne';
        $valueAktivovatPrihlaskyIIBeh = $request->has('aktivovat_prihlasku_2beh') ? 'ano' : 'ne';

        SettingsModel::where('typ_nastaveni','Spuštění přihlášek - 1.běh')->update(['hodnota_nastaveni' => $valueSpustitPrihlasky]);
        SettingsModel::where('typ_nastaveni','Aktivace přihlášek - 2. běh')->update(['hodnota_nastaveni' => $valueAktivovatPrihlaskyIIBeh]);

        return redirect()->back()->with('success', 'Nastavení uloženo');
    }
}
