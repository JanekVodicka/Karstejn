<?php

namespace App\Http\Controllers;

use App\Models\RocnikyModel;
use App\Models\AkceModel;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function showToGalerie(string $event, string $date)
    {
        $images = $this->getImagesForYear($event, $date);
        
        $albumsRocniky = RocnikyModel::select('rok', 'tema_1beh', 'zobrazit_v_galerii')
        ->where('zobrazit_v_galerii', 'ano')
        ->get()
        ->keyBy('rok')
        ->toArray();
    
        $albumsAkce = AkceModel::select('termin_akce', 'tema_akce')
        ->get()
        ->keyBy('termin_akce')
        ->toArray();

        return view("partials.galery", [
            'event' => $event,
            'date' => $date,
            'images' => $images,
            'albumsRocniky' => $albumsRocniky,
            'albumsAkce' => $albumsAkce,
        ]);
    }

    public function showToGalerieRocniky()
    {
        $albumsRocniky = RocnikyModel::select('rok', 'tema_1beh', 'zobrazit_v_galerii')
        ->where('zobrazit_v_galerii', 'ano')
        ->get()
        ->keyBy('rok')
        ->toArray();

        $reversedAlbumRocniky = array_reverse($albumsRocniky);

        $transformedAlbumRocniky = [];
        foreach ($reversedAlbumRocniky as $item) {
            $transformedAlbumRocniky[$item['rok']] = $item;
        }

        return view("galerie_rocniky", ['albumsRocniky' => $transformedAlbumRocniky]);
    }

    public function showToGalerieAkce()
    {
        $albumsAkce = AkceModel::select('termin_akce', 'tema_akce')
        ->get()
        ->keyBy('termin_akce')
        ->toArray();

        $reversedAlbumAkce = array_reverse($albumsAkce);

        $transformedAlbumRocniky = [];
        foreach ($reversedAlbumAkce as $item) {
            $transformedAlbumAkce[$item['termin_akce']] = $item;
        }

        return view("galerie_akce", ['albumsAkce' => $transformedAlbumAkce]);
    }

    private function getImagesForYear($event, $date)
    {
        $directory = public_path("images/{$event}/{$date}");
        if (!is_dir($directory)) return [];

        return array_map(function ($file) use ($event, $date) {
            return "images/{$event}/{$date}/" . basename($file);
        }, glob("{$directory}/*.jpg"));
    }
}
