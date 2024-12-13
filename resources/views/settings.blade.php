@extends('layouts.app')
@section('title', 'Nastavení')
@section('content')
    <div class="container">
        <div class="settings">
            @include('partials.settings-nav', ['active' => 'settings'])  
            <form id="settings-form" action="{{ route('update.settings') }}" method="POST">
                @csrf
                <div class="nastaveni-prihlasky">
                    <table>
                        <thead>
                            <tr>
                                <th>Aktivita přihlášek:</th>
                                <th style="width: 100px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Spustit přihlášky 1.běhu:</td>
                                <td>
                                    <div class="toggle-switch">
                                        <input class="checkbox-toggle" type="checkbox" id="prihlasky-1beh-aktivita" name="spustit_prihlasku" @if($spusteni_prihlasek == 'ano') checked @endif>
                                        <label class="toggle" for="prihlasky-1beh-aktivita"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Aktivovat přihlášky 2.běhu:</td>
                                <td>
                                    <div class="toggle-switch">  
                                        <input class="checkbox-toggle" type="checkbox" id="prihlasky-2beh-aktivita" name="aktivovat_prihlasku_2beh" @if($aktivace_prihlasek_2beh == 'ano') checked @endif>
                                        <label class="toggle" for="prihlasky-2beh-aktivita"></label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="submit-form">
                    <input type="submit" value="Uložit">
                </div>
            </form>
        </div>
    </div>
@endsection