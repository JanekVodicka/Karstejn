@extends('layouts.app')
@section('title', 'Galerie-Ročníky')
@section('content')
    <div class="container">
        @include('partials.galery-nav', ['active' => 'rocniky', 'activealbum' => '', 'year' => '', 'albumname' => ''])
        <div class="photo-gallery">
            @php
                $albums = [
                    ['year' => '2024', 'title' => 'POHÁDKOVÁ ZEMĚ V OHROŽENÍ'],
                    ['year' => '2023', 'title' => 'POSLEDNÍ PŘESUN'],
                    ['year' => '2022', 'title' => 'KARLÍK A TOVÁRNA NA ČOKOLÁDU'],
                    ['year' => '2021', 'title' => 'ASTERIX A OBELIX'],
                    ['year' => '2020', 'title' => 'COVID'],
                    ['year' => '2019', 'title' => 'SHERLOCK HOLMES'],
                    ['year' => '2018', 'title' => 'CESTA ZA SVĚTOVÝM MÍREM'],
                    ['year' => '2017', 'title' => 'PRAVĚK'],
                    ['year' => '2016', 'title' => 'PÁN PRSTEJNŮ'],
                    ['year' => '2015', 'title' => 'INDIÁNI - LAKHOTA OYATE'],
                    ['year' => '2014', 'title' => 'ROBIN HOOD'],
                    ['year' => '2013', 'title' => 'MAFIE'],
                    ['year' => '2012', 'title' => 'ZA ZDÍ'],
                    ['year' => '2011', 'title' => 'ŘÍMSKÁ LEGIE'],
                    ['year' => '2010', 'title' => 'TAJEMSTVÍ KARŠTEJNSKÉHO ŘÁDU'],
                    ['year' => '2009', 'title' => 'CESTA ZA POKLADEM'],
                    ['year' => '2008', 'title' => 'EGYPT'],
                    ['year' => '2007', 'title' => 'PO STOPÁCH YETTIHO'],
                    ['year' => '2006', 'title' => 'BRADAVICKÁ ŠKOLA ČAR A KOUZEL'],
                    ['year' => '2005', 'title' => 'INDIÁNI - LAKHOTA OYATE'],
                    ['year' => '2004', 'title' => 'BOJ O VELKÉHO VONTA'],
                    ['year' => '2003', 'title' => 'JAPONSKO'],
                    ['year' => '2002', 'title' => 'PIRÁTI'],
                    ['year' => '2001', 'title' => 'ČUMAZIMURC'],
                    ['year' => '2000', 'title' => 'GOLEM'],
                ];
            @endphp

            @foreach ($albums as $album)
                <div class="album" style="background-image: url(images/rocniky/{{ $album['year'] }}.jpg);">
                    <a href="{{ url("galerie/rocniky/{$album['year']}") }}">
                        <div class="img-text">{{ $album['year'] }}</div>
                        <div class="img-text-hidden">{{ $album['title'] }}</div>
                    </a>
                </div>
            @endforeach
            
        </div>
    </div>
@endsection
