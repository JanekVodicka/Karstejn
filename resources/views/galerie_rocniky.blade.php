@extends('layouts.app')
@section('title', 'Galerie-Ročníky')
@section('content')
    <div class="container">
        <div class="galerie">
            @include('partials.galery-nav', ['active' => 'rocniky', 'activealbum' => '', 'year' => '', 'albumname' => ''])
            <div class="photo-gallery">
                @foreach ($albumsRocniky as $album)
                    <div class="album" style="background-image: url(images/rocniky/{{ $album['rok'] }}.jpg);">
                        <a href="{{ url("galerie/rocniky/{$album['rok']}") }}">
                            <div class="img-text">{{ $album['rok'] }}</div>
                            <div class="img-text-hidden">{{ $album['tema_1beh'] }}</div>
                        </a>
                    </div>
                @endforeach    
            </div>
        </div> 
    </div>
@endsection
