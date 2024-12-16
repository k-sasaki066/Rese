@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
@endsection

@section('content')

@if (session('result'))
    <div class="flash_error-message">
        {{ session('result') }}
    </div>
@endif

<div class="login-container common-shadow">
    <p class="login-form__title">
        Login
    </p>
    <form class="login-form" action="/login" method="post">
        @csrf
        <div class="form-group">
            <img class="login-icon" src="{{ asset('/images/email.svg') }}" alt="name">
            <div class="form-group__item">
                <input class="form-group__input" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                <div class="error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <img class="login-icon" src="{{ asset('/images/password.svg') }}" alt="password">
            <div class="form-group__item">
                <input class="form-group__input" type="password" name="password" placeholder="Password" value="{{ old('password') }}">
                <div class="error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <button class="login-form__submit common-btn" type="submit">
            ログイン
        </button>
    </form>
</div>
@endsection