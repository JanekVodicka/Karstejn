@extends('layouts.app')

@section('title', "Galerie $event $date")

@section('content')
    <div class="container">
        <div class="galerie">
            @if ($event == 'rocniky')
            @include('partials.galery-nav', ['active' => $event, 'activealbum' => 'rocniky', 'year' => $date, 'albumname' => $albumsRocniky[$date]['tema_1beh']])
        @elseif ($event == 'akce')
            @include('partials.galery-nav', ['active' => $event, 'activealbum' => 'akce', 'year' => $date, 'albumname' => $albumsAkce[$date]['tema_akce']])
        @endif

        <div class="photo-gallery">
            @foreach($images as $index => $image)
                <div class="pic" data-index="{{ $index + 1 }}">
                    <img src="{{ asset($image) }}" alt="Karštejn {{ $date }} Image {{ $index + 1 }}">
                </div>
            @endforeach
        </div>
        </div>
    </div>
@endsection
