@extends('layouts.app')
@section('title', 'login')
@section('content')
    <div class="container"> 
        <div id="log-form">
            <form action="{{ route('login.form') }}" method="POST">
                @csrf
                    <div class="formular">
                        <h3>Přihlášení</h3>
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
        
                        <div class="prihlaseni-status">
                            @if (Auth::check())
                                <p>Uživatel přihlášen jako: <strong>{{ Auth::user()->name }}</strong></p>
                            @else
                                <p>Nejsi přihlášen(a)</p>
                            @endif
                        </div>
        
                        @if(session('error-login-role'))
                            <div class="error-login-role-message">
                                {{ session('error-login-role')}}
                            </div>
                        @endif
        
                        @if ($errors->has('error-login-credentials'))
                            <div class="error-login-credentials-message">
                                {{ $errors->first('error-login-credentials') }}
                            </div>
                        @endif
        
                    </div>
                </form>
        </div>
    </div>
@endsection