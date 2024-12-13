@extends('layouts.app')
@section('title', 'Galerie-Videa')
@section('content')
    <div class="container">
        <div class="galerie">
            @include('partials.galery-nav', ['active' => 'videa', 'activealbum' => '', 'year' => '', 'albumname' => ''])
            <div class="photo-gallery">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/J-LVfhnlqu8?si=0Hkvro7nBY8GQhwG"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection