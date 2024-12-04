@extends('layouts.app')
@section('title', 'login')
@section('content')
    <div class="container"> 

        @if(session('error'))
            <div class="error-message">
                {{ session('error')}}
            </div>
        @endif

        <form action="{{ route('login.form') }}" method="POST">
        @csrf
            <div class="formular">
                <h2>Přihlášení</h2>
                <div class="input-box">
                    <label class="main-label" for="login-name">Uživatelské jméno:</label>
                    <input class="input-text" type="text" id="login-name" name="login_name" placeholder="Uživatelské jméno">
                </div>
                <div class="input-box">
                    <label class="main-label" for="login-password">Heslo:</label>
                    <input class="input-text" type="password" id="login-password" name="login_password" placeholder="Heslo">
                </div>
                <div class="submit-form">
                    <input type="submit" value="Přihlásit">
                </div>
            </div>
        </form>

        <div class="prihlaseni-status">
            @if (Auth::check())
            <p>Uživatel přihlášen jako: <strong>{{ Auth::user()->name }}</strong></p>
            @else
                <p>Nejsi přihlášen(a)</p>
            @endif
        </div>
    </div>
@endsection