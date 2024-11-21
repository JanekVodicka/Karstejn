<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function show(string $event, string $year)
    {
        $images = $this->getImagesForYear($event, $year);

        $albums_rocniky = [
            '2024' => ['year' => '2024', 'title' => 'POHÁDKOVÁ ZEMĚ V OHROŽENÍ'],
            '2023' => ['year' => '2023', 'title' => 'POSLEDNÍ PŘESUN'],
            '2022' => ['year' => '2022', 'title' => 'KARLÍK A TOVÁRNA NA ČOKOLÁDU'],
            '2021' => ['year' => '2021', 'title' => 'ASTERIX A OBELIX'],
            '2020' => ['year' => '2020', 'title' => 'COVID'],
            '2019' => ['year' => '2019', 'title' => 'SHERLOCK HOLMES'],
            '2018' => ['year' => '2018', 'title' => 'CESTA ZA SVĚTOVÝM MÍREM'],
            '2017' => ['year' => '2017', 'title' => 'PRAVĚK'],
            '2016' => ['year' => '2016', 'title' => 'PÁN PRSTEJNŮ'],
            '2015' => ['year' => '2015', 'title' => 'INDIÁNI - LAKHOTA OYATE'],
            '2014' => ['year' => '2014', 'title' => 'ROBIN HOOD'],
            '2013' => ['year' => '2013', 'title' => 'MAFIE'],
            '2012' => ['year' => '2012', 'title' => 'ZA ZDÍ'],
            '2011' => ['year' => '2011', 'title' => 'ŘÍMSKÁ LEGIE'],
            '2010' => ['year' => '2010', 'title' => 'TAJEMSTVÍ KARŠTEJNSKÉHO ŘÁDU'],
            '2009' => ['year' => '2009', 'title' => 'CESTA ZA POKLADEM'],
            '2008' => ['year' => '2008', 'title' => 'EGYPT'],
            '2007' => ['year' => '2007', 'title' => 'PO STOPÁCH YETTIHO'],
            '2006' => ['year' => '2006', 'title' => 'BRADAVICKÁ ŠKOLA ČAR A KOUZEL'],
            '2005' => ['year' => '2005', 'title' => 'INDIÁNI - LAKHOTA OYATE'],
            '2004' => ['year' => '2004', 'title' => 'BOJ O VELKÉHO VONTA'],
            '2003' => ['year' => '2003', 'title' => 'JAPONSKO'],
            '2002' => ['year' => '2002', 'title' => 'PIRÁTI'],
            '2001' => ['year' => '2001', 'title' => 'ČUMAZIMURC'],
            '2000' => ['year' => '2000', 'title' => 'GOLEM'],
        ];

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

    private function getImagesForYear($event, $year)
    {
        $directory = public_path("images/{$event}/{$year}");
        if (!is_dir($directory)) return [];

        return array_map(function ($file) use ($event, $year) {
            return "images/{$event}/{$year}/" . basename($file);
        }, glob("{$directory}/*.jpg"));
    }
}
