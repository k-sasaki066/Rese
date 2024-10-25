@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
@endsection

@section('content')
<div class="login-container common-shadow">
    <p class="login-form__title">
        Login
    </p>
    <form class="login-form" action="" method="">
        <div class="form-group">
            <img class="login-icon" src="../images/email.svg" alt="name">
            <div class="form-group__item">
                <input class="form-group__input" type="text" name="email" placeholder="Email" value="">
                <div class="error-message">
                    message
                </div>
            </div>
        </div>

        <div class="form-group">
            <img class="login-icon" src="../images/password.svg" alt="password">
            <div class="form-group__item">
                <input class="form-group__input" type="password" name="password" placeholder="Password" value="">
                <div class="error-message">
                    message
                </div>
            </div>
        </div>

        <button class="login-form__submit common-btn" type="submit">
            ログイン
        </button>
    </form>
</div>
@endsection