@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
@endsection

@section('content')
<div class="register-container common-shadow">
    <p class="register-form__title">
        Registration
    </p>

    <form class="register-form" action="" method="">
        <div class="form-group">
            <img class="register-icon" src="../images/username.svg" alt="name">
            <div class="form-group__item">
                <input class="form-group__input" type="text" name="name" placeholder="Username" value="">
                <div class="error-message">
                    message
                </div>
            </div>
        </div>

        <div class="form-group">
            <img class="register-icon" src="../images/email.svg" alt="email">
            <div class="form-group__item">
                <input class="form-group__input" type="text" name="email" placeholder="Email" value="">
                <div class="error-message">
                    message
                </div>
            </div>
        </div>

        <div class="form-group">
            <img class="register-icon" src="../images/password.svg" alt="password">
            <div class="form-group__item">
                <input class="form-group__input" type="password" name="password" placeholder="Password" value="">
                <div class="error-message">
                    message
                </div>
            </div>
        </div>

        <button class="register-form__submit common-btn" type="submit">
            登録
        </button>
    </form>
</div>
@endsection