@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
@endsection

@section('content')
@if (session('result'))
    <div class="flash_message">
        {{ session('result') }}
    </div>
@endif

<div class="register-container common-shadow">
    <p class="register-form__title">
        Registration
    </p>

    <form class="register-form" action="/register" method="post">
        @csrf
        <div class="form-group">
            <img class="register-icon" src="../images/username.svg" alt="name">
            <div class="form-group__item">
                <input class="form-group__input" type="text" name="name" placeholder="Username" value="{{ old('name') }}">
                <div class="error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <img class="register-icon" src="../images/email.svg" alt="email">
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
            <img class="register-icon" src="../images/password.svg" alt="password">
            <div class="form-group__item">
                <input class="form-group__input" type="password" name="password" placeholder="Password" value="{{ old('password') }}">
                <div class="error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <button class="register-form__submit common-btn" type="submit">
            登録
        </button>
    </form>
</div>
@endsection