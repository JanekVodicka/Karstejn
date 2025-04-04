@extends('layouts.app')
@section('title', 'Přihlášky - databáze')
@section('content')
    <div class="container">
        <div class="settings">
            @include('partials.settings-nav', ['active' => 'prihlasky-private'])
            <div class="prihlasky-status">
                <table>
                    <tbody>
                        <tr>
                            <td><strong>Celkový počet přihlášených:</strong></td>
                            <td>{{ $pocet_prihlasek }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>VS</th>
                            <th>Jméno rodiče</th>
                            <th>Email</th>
                            <th>Číslo</th>
                            <th>Jméno dítěte</th>
                            <th>Místo nástupu</th>
                            <th>Plavec?</th>
                            <th>Velikost trika</th>
                            <th>Souhlas fotky</th>
                            <th>Faktura</th>
                            <th>Poznámka rodič</th>
                            <th>Specialista</th>
                            <th>Poznámka dítě</th>
                            <th>Odesláno?</th>
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
                        <td>{{ $prihlaska['facture'] }}</td>
                        <td>{{ $prihlaska['parent_note'] }}</td>
                        <td>{{ $prihlaska['specialista'] }}</td>
                        <td>{{ $prihlaska['child_note'] }}</td>
                        <td>{{ $prihlaska['zprocesovano'] }}</td>
                    </tr>  
                    @endforeach
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
@endsection