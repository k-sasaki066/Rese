@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}">

@section('content')
    <div class="verify-email__header">
        <h2 class="verify-email__header-text">
            @if(Auth::user()->hasRole('editor'))
            {{ __('ご登録いただいたメールアドレスに、
            確認用のリンクをお送りします。') }}
            @else
            {{ __('ご登録いただいたメールアドレスに、
            確認用のリンクをお送りしました。') }}
            @endif
        </h2>
    </div>
    <div class="verify-email__content">
        <p class="verify-email__text">
            @if(Auth::user()->hasRole('editor'))
            {{ __('下記をクリックして、送信されたメールをご確認ください。') }}
            @else
            {{ __('もし確認用メールが送信されていない場合は、下記をクリックしてください。') }}
            @endif
        </p>
        <form class="verify-email__form" method="post" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="verify-email__form-button">
                @if(Auth::user()->hasRole('editor'))
                {{ __('確認メールを送信する') }}
                @else
                {{ __('確認メールを再送信する') }}
                @endif
            </button>
        </form>

        <form class="verify-email__back-form" method="post" action="/logout">
            @csrf
            <button class="verify-email__back">
                {{ __('ログアウト') }}
            </button>
        </form>
    </div>
@endsection