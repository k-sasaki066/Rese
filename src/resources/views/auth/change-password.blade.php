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
        本パスワード登録
    </p>

    <form class="register-form" action="/editor/change" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <img class="register-icon" src="{{ asset('/images/email.svg') }}" alt="email">
            <div class="form-group__item">
                <input class="form-group__input" type="text" name="email" placeholder="登録しているメールアドレス" value="{{ old('email') }}">
                <div class="error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <img class="register-icon" src="{{ asset('/images/password.svg') }}" alt="password">
            <div class="form-group__item">
                <input class="form-group__input" type="password" name="oldPassword" placeholder="現在のパスワード" value="{{ old('oldPassword') }}">
                <div class="error-message">
                    @error('oldPassword')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <img class="register-icon" src="{{ asset('/images/password.svg') }}" alt="password">
            <div class="form-group__item">
                <input class="form-group__input" type="password" name="newPassword" placeholder="新しいパスワード" value="{{ old('newPassword') }}">
                <div class="error-message">
                    @error('newPassword')
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