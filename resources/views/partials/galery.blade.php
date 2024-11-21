@extends('layouts.app')

@section('title', "Galerie $event $year")

@section('content')
    <div class="container">
        @if ($event == 'rocniky')
            @include('partials.galery-nav', ['active' => $event, 'activealbum' => 'rocniky', 'albumname' => $albums_rocniky[$year]['title']])
        @elseif ($event == 'akce')
            @include('partials.galery-nav', ['active' => $event, 'activealbum' => 'akce', 'albumname' => $albums_akce[$year]['title']])
        @endif

        <div class="photo-gallery">
            @foreach($images as $index => $image)
                <div class="pic" data-index="{{ $index + 1 }}">
                    <img src="{{ asset($image) }}" alt="Karštejn {{ $year }} Image {{ $index + 1 }}">
                </div>
            @endforeach
        </div>
    </div>
@endsection
