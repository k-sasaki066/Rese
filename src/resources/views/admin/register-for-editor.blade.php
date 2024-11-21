@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
<link rel="stylesheet" href="{{ asset('css/admin/register-for-editor.css')}}">
@endsection

@section('content')
@if (session('result'))
    <div class="flash_message">
        {{ session('result') }}
    </div>
@endif

<div class="register-editor__container common-shadow">
    <p class="register-editor__form-title">
        店舗代表者登録
    </p>

    <form class="register-form" action="/editor/register" method="post">
        @csrf
        <div class="form-group">
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
            <div class="form-group__item">
                <input class="form-group__input" type="password" name="password" placeholder="Password" value="{{ old('password') }}">
                <div class="error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group__select">
            <div class="form-group__item form__select-inner">
                <select class="register-editor__select" name="shop_id" id="">
                    <option value="">店舗を選択してください</option>
                    <option value="new">新規登録</option>
                    @foreach($shops as $shop)
                        <option value="{{ $shop['id'] }}" {{ old('shop_id')==$shop['id'] ? 'selected' : '' }}>{{ $shop['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="error-message">
                @error('shop_id')
                {{ $message }}
                @enderror
            </div>
        </div>

        <button class="register-form__submit common-btn" type="submit">
            登録
        </button>
    </form>
</div>
@endsection