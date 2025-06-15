@extends('layouts.app')
@section('title', 'Galerie-Akce')
@section('content')
    <div class="container">
        <div class="galerie">
            @include('partials.galery-nav', ['active' => 'akce', 'activealbum' => '', 'year' => '', 'albumname' => ''])
            <div class="photo-gallery">
                @foreach ($albumsAkce as $album)
                    <div class="album" style="background-image: url(images/akce/{{ $album['termin_akce'] }}.jpg);">
                        <a href="{{ url("galerie/akce/{$album['termin_akce']}") }}">
                            <div class="img-text">{{ $album['termin_akce'] }}</div>
                            <div class="img-text-hidden">{{ $album['tema_akce'] }}</div>
                        </a>
                    </div>
                @endforeach 
            </div>
        </div>
    </div>
@endsection