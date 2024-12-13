@extends('layouts.app')
@section('title', 'Galerie-Ostatni')
@section('content')
    <div class="container">
        <div class="galerie">
            @include('partials.galery-nav', ['active' => 'ostatni', 'activealbum' => '', 'year' => '', 'albumname' => ''])
            <div class="container">
                <div class="photo-gallery">
                </div>
            </div>
        </div>
    </div>
@endsection