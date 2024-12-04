<?php

namespace App\Http\Controllers;

use App\Models\RocnikyModel;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function showToGalerie(string $event, string $year)
    {
        $images = $this->getImagesForYear($event, $year);
        $albums_rocniky = RocnikyModel::select('rok', 'tema_1beh')->get()->keyBy('rok')->toArray();

        $albums_akce = [
            '2007' => ['year' => '2007', 'title' => 'Víkendovka - ZÁCHRANÁŘI'],
            '2006' => ['year' => '2006', 'title' => 'Víkendovka - SEZNAMOVACÍ'],
        ];

        return view("partials.galery", [
            'event' => $event,
            'year' => $year,
            'images' => $images,
            'albums_rocniky' => $albums_rocniky,
            'albums_akce' => $albums_akce,
        ]);
    }

    public function showToGalerieRocniky()
    {
        $albums_rocniky = RocnikyModel::select('rok', 'tema_1beh')->get()->toArray();
        $reversed_album_rocniky = array_reverse($albums_rocniky);

        $transformed_album_rocniky = [];
        foreach ($reversed_album_rocniky as $item) {
            $transformed_album_rocniky[$item['rok']] = $item;
        }

        return view("galerie_rocniky", ['albums_rocniky' => $transformed_album_rocniky]);
    }

    private function getImagesForYear($event, $year)
    {
        $directory = public_path("images/{$event}/{$year}");
        if (!is_dir($directory)) return [];

        return array_map(function ($file) use ($event, $year) {
            return "images/{$event}/{$year}/" . basename($file);
        }, glob("{$directory}/*.jpg"));
    }
}
