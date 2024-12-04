@extends('layouts.app')

@section('title', "Galerie $event $year")

@section('content')
    <div class="container">
        @if ($event == 'rocniky')
            @include('partials.galery-nav', ['active' => $event, 'activealbum' => 'rocniky', 'year' => $year, 'albumname' => $albums_rocniky[$year]['tema_1beh']])
        @elseif ($event == 'akce')
            @include('partials.galery-nav', ['active' => $event, 'activealbum' => 'akce', 'year' => $year, 'albumname' => $albums_akce[$year]['tema']])
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
