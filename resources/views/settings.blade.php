@extends('layouts.app')
@section('title', 'Nastavení')
@section('content')
    <div class="container">
        @include('partials.settings-nav', ['active' => 'settings', 'activealbum' => '', 'year' => '', 'albumname' => ''])
        <div class="photo-gallery">
            <h3>Aktivita přihlášek</h3>
            <input type="checkbox" id="prihlasky-aktivita">
            <label for="prihlasky-aktivita"></label>
            <div class="obdelnik"></div>
        </div>
    </div>
@endsection