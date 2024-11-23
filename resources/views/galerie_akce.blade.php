@extends('layouts.app')
@section('title', 'Galerie-Akce')
@section('content')
    <div class="container">
        @include('partials.galery-nav', ['active' => 'akce', 'activealbum' => '', 'year' => '', 'albumname' => ''])
        <div class="photo-gallery">
            @php
                $albums = [
                    ['year' => '2007', 'title' => 'Víkendovka - ZÁCHRANÁŘI'],
                    ['year' => '2006', 'title' => 'Víkendovka - SEZNAMOVACÍ'],
                ];

            @endphp

            @foreach ($albums as $album)
                <div class="album" style="background-image: url(images/akce/{{ $album['year'] }}.jpg);">
                    <a href="{{ url("galerie/akce/{$album['year']}") }}">
                        <div class="img-text">{{ $album['year'] }}</div>
                        <div class="img-text-hidden">{{ $album['title'] }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection