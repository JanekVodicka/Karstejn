@extends('layouts.app')
@section('title', 'Přihlášky - databáze')
@section('content')
    <div class="container">
        <h2>Přihlášky</h2>
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Jméno rodiče</td>
                    <td>VS</td>
                    <td>Email</td>
                    <td>Číslo</td>
                    <td>Jméno dítěte</td>
                    <td>Místo nástupu</td>
                    <td>Plavec?</td>
                    <td>Velikost trika?</td>
                    <td>Souhlas fotky</td>
                    <td>Faktura?</td>
                    <td>Poznámka rodič</td>
                    <td>Poznámka dítě</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($prihlasky as $prihlaska)
            <tr>
                <td>{{ $prihlaska['id'] }}</td>
                <td>{{ $prihlaska['variable_symbol'] }}</td>
                <td>{{ $prihlaska['parent_names'] }}</td>
                <td>{{ $prihlaska['parent_email'] }}</td> 
                <td>{{ $prihlaska['parent_number'] }}</td>
                <td>{{ $prihlaska['child_first_name'] }} {{ $prihlaska['child_last_name'] }}</td>
                <td>{{ $prihlaska['misto_nastupu'] }}</td>
                <td>{{ $prihlaska['plavec'] }}</td>
                <td>{{ $prihlaska['velikost_trika'] }}</td>
                <td>{{ $prihlaska['photos_agreement'] }}</td>
                <td>{{ $prihlaska['faktura'] }}</td>
                <td>{{ $prihlaska['parent_note'] }}</td>
                <td>{{ $prihlaska['child_note'] }}</td>
            </tr>  
            @endforeach
            </tbody> 
        </table>
    </div>
@endsection