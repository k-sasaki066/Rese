@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/email-notification.css')}}">
@endsection

@section('content')
@if (session('result'))
    <div class="flash_success-message">
        {{ session('result') }}
    </div>
@endif

<div class="notification__container">
    <h2 class="notification__header">
        Email Notification
    </h2>

    <div class="notification__content-group common-shadow">
        <form action="/admin/email" method="post" class="notification__form">
            @csrf
            <div class="notification__address">
                <select name="address" id="" class="notification__address-select">
                    <option value="">宛先を選択してください</option>
                    <option value="all" {{ old('address') == 'all' ? 'selected' : '' }}>全員</option>
                    <option value="user" {{ old('address') == 'user' ? 'selected' : '' }}>一般ユーザー</option>
                    <option value="editor" {{ old('address') == 'editor' ? 'selected' : '' }}>店舗代表者</option>
                    <option value="admin" {{ old('address') == 'admin' ? 'selected' : '' }}>管理者</option>
                </select>
            </div>
            <div class="error-message">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>

            <div class="notification__content-textarea">
                <textarea class="notification__textarea-input" name="text" rows="10" placeholder="本文を入力してください">{{ old('text') }}</textarea>
            </div>
            <div class="error-message">
                    @error('text')
                    {{ $message }}
                    @enderror
                </div>
            <div class="notification-form__button">
                <a href="#send" class="send__button common-btn">メール送信</a>
                <a href="/mypage" class="back__button">戻る</a>
            </div>

            <div class="modal__group" id="send">
                <a class="modal-overlay" href="#!"></a>
                <div class="modal__inner">
                    <div class="close-detail__modal">
                        <a href="#!" class="close-detail__button"><img class="close-detail__button-img" src="../../images/close-btn.svg" alt="閉じる"></a>
                    </div>
                    <div class="modal__content">
                        <p class="modal__content-text">メールを送信します。よろしいですか？</p>
                        <button class="common-btn modal-btn" type="submit">送信</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection