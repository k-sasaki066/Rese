@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/index.css')}}">
<link rel="stylesheet" href="{{ asset('css/user/mypage.css')}}">
@endsection

@section('content')
@if (session('result'))
    <div class="flash_success-message">
        {{ session('result') }}
    </div>
@endif

<p class="user__name">
    {{ Auth::user()->name }}さん
</p>
<div class="mypage__container">
    <div class="reservation-status__group">
        <h2 class="reservation-status__title">
            予約状況
        </h2>

        @foreach($reservations as $reservation)
        <div class="reservation-status__content common-shadow">
            <div class="reservation-status__text">
                <img class="reservation-status__icon" src="../images/time.svg" alt="時計">
                <p class="reservation-status__number">
                    予約{{$counter}}
                </p>
                <a href="#{{ $reservation['id'] }}">
                    <img class="reservation-cancel__btn-img" src="../images/close-btn.svg" alt="">
                </a>
            </div>

            <table class="reservation-status__table">
                <tr class="reservation-status__table-row">
                    <th class="reservation-status__table-header">
                        Shop
                    </th>
                    <td class="reservation-status__table-item">
                        {{ $reservation['shop']['name'] }}
                    </td>
                </tr>
                <tr class="reservation-status__table-row">
                    <th class="reservation-status__table-header">
                        Date
                    </th>
                    <td class="reservation-status__table-item">
                        {{ $reservation['date'] }}
                    </td>
                </tr>
                <tr class="reservation-status__table-row">
                    <th class="reservation-status__table-header">
                        Time
                    </th>
                    <td class="reservation-status__table-item">
                        {{ substr($reservation['time'], 0, 5) }}
                    </td>
                </tr>
                <tr class="reservation-status__table-row">
                    <th class="reservation-status__table-header">
                        Number
                    </th>
                    <td class="reservation-status__table-item">
                        {{ $reservation['number'] }}
                    </td>
                </tr>
            </table>
            <div class="reservation__edit-group">
                <a class="common-btn reservation__edit-btn" href="#edit{{ $reservation['id'] }}">
                    <img class="edit-icon" src="../images/edit.svg" alt="pen">edit
                </a>
            </div>
        </div>

        <div class="modal__group" id="{{ $reservation['id'] }}">
            <a href="#!" class="modal-overlay"></a>
            <div class="modal__inner">
                <div class="close-detail__modal">
                    <a class=".close-detail__button" href="#"><img class="close-detail__button-img" src="../images/close-btn.svg" alt="閉じる"></a>
                </div>
                <div class="modal__content">
                    <p class="modal__content-text">この予約をキャンセルします。<br>よろしいですか？</p>
                    <table class="reservation-status__table reservation-status__table-modal">
                        <tr class="reservation-status__table-row">
                            <th class="reservation-status__table-header">
                                Shop
                            </th>
                            <td class="reservation-status__table-item">
                                {{ $reservation['shop']['name'] }}
                            </td>
                        </tr>
                        <tr class="reservation-status__table-row">
                            <th class="reservation-status__table-header">
                                Date
                            </th>
                            <td class="reservation-status__table-item">
                                {{ $reservation['date'] }}
                            </td>
                        </tr>
                        <tr class="reservation-status__table-row">
                            <th class="reservation-status__table-header">
                                Time
                            </th>
                            <td class="reservation-status__table-item">
                                {{ substr($reservation['time'], 0, 5) }}
                            </td>
                        </tr>
                        <tr class="reservation-status__table-row">
                            <th class="reservation-status__table-header">
                                Number
                            </th>
                            <td class="reservation-status__table-item">
                                {{ $reservation['number'] }}
                            </td>
                        </tr>
                    </table>
                    <form class="reservation__delete-form" action="mypage/delete/{{$reservation['id']}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="common-btn delete-btn" type="submit">予約キャンセル</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal__group" id="edit{{ $reservation['id'] }}">
            <a href="#!" class="modal-overlay"></a>
            <div class="modal__inner">
                <div class="close-detail__modal">
                    <a class=".close-detail__button" href="#"><img class="close-detail__button-img" src="../images/close-btn.svg" alt="閉じる"></a>
                </div>
                <p class="modal__content-text">
                        予約情報更新
                    </p>
                <div class="modal__content">
                    @livewire('reservation-edit', ['reservation'=> $reservation ])
                </div>
            </div>
        </div>
        <?php $counter++ ?>
        @endforeach
    </div>

    <div class="favorite-store__list-group">
        <h2 class="favorite-store__list-title">
            お気に入り店舗
        </h2>

        <div class="favorite-store__list-content">
            @foreach($shops as $shop)
            @if(in_array($shop['id'], $favorites))
            <div class="store-list__item common-shadow">
                <img class="store-list__img" src="{{ $shop['image_url'] }}" alt="店舗画像">
                <div class="store-list__text">
                    <p class="store-list__name">
                        {{ $shop['name'] }}
                    </p>
                    <div class="store-list__tag">
                        <span class="store-list__area-tag">
                        #{{ $shop['area']['name'] }}
                        </span>
                        <span class="store-list__genre-tag">
                            #{{ $shop['genre']['name'] }}
                        </span>
                    </div>
                    <div class="store-list__form">
                        <form class="store-list__detail-form" action="/detail/{{ $shop['id']}}" method="get">
                        @csrf
                            <button class="common-btn store-list__detail-btn" type="submit">
                                詳しくみる
                            </button>
                        </form>
                        @livewire('favorite-form', ['shop'=>$shop, 'favorites'=>$favorites])
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection