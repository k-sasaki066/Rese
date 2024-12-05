@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/visit-history.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection

@section('content')
@if (session('result'))
    <div class="flash_success-message">
        {{ session('result') }}
    </div>
@endif

<div class="history-table__container">
    <h2 class="history-table__text">
        来店履歴
    </h2>
    <div class="history-table__group">
        <table class="history-table">
            <tr class="history-table__row">
                <th class="history-table__heading">No.</th>
                <th class="history-table__heading">来店日</th>
                <th class="history-table__heading">来店時間</th>
                <th class="history-table__heading">店舗名</th>
                <th class="history-table__heading"></th>
            </tr>
            @foreach($reservations as $reservation)
            <tr class="history-table__row">
                <td class="history-table__item">
                    {{ $counter }}
                </td>
                <td class="history-table__item">
                    {{ $reservation['date'] }}
                </td>
                <td class="history-table__item">
                    {{ substr($reservation['time'], 0,5) }}
                </td>
                <td class="history-table__item">
                    {{ $reservation['shop']['name'] }}
                </td>
                <td class="history-table__item">
                    @if($reservation->rating == null)
                    <a class="rating-post__modal" href="#{{ $reservation['id'] }}">レビューを投稿する</a>
                    @else
                    <p class="rating-post__completion">投稿済み</p>
                    @endif
                </td>
            </tr>
            @php
            $counter++
            @endphp

            <div class="modal__group" id="{{ $reservation['id'] }}">
            <a href="#!" class="modal-overlay"></a>
            <div class="modal__inner">
                <div class="close-detail__modal">
                    <a class=".close-detail__button" href="#"><img class="close-detail__button-img" src="../../images/close-btn.svg" alt="閉じる"></a>
                </div>
                <div class="modal__content">
                    <p class="modal__content-text">レビュー投稿</p>
                    <form class="form__rating-post" action="/history" method="post">
                    @csrf
                        <div class="form-rating__container">
                            <div class="form-rating__group">
                                <label class="form-rating__label" for="">店舗名：</label>
                                <p class="form-rating__store">{{ $reservation['shop']['name'] }}</p>
                                <input type="hidden"  name="shop_id" value="{{ $reservation['shop_id'] }}">
                                <input type="hidden"  name="reservation_id" value="{{ $reservation['id'] }}">
                            </div>
                            <div class="form-rating__group">
                                <label class="form-rating__label" for="">評価：</label>
                                <div class="form-rating">
                                    <input class="form-rating__input" id="star5-{{ $reservation['id'] }}" name="rating" type="radio" value="5" {{ (old('rating') == 5) ? 'checked' : ''}}>
                                    <label class="form-rating__star" for="star5-{{ $reservation['id'] }}"><i class="fa-solid fa-star"></i></label>

                                    <input class="form-rating__input" id="star4-{{ $reservation['id'] }}" name="rating" type="radio" value="4" {{ (old('rating') == 4) ? 'checked' : ''}}>
                                    <label class="form-rating__star" for="star4-{{ $reservation['id'] }}"><i class="fa-solid fa-star"></i></label>

                                    <input class="form-rating__input" id="star3-{{ $reservation['id'] }}" name="rating" type="radio" value="3" {{ (old('rating') == 3) ? 'checked' : ''}}>
                                    <label class="form-rating__star" for="star3-{{ $reservation['id'] }}"><i class="fa-solid fa-star"></i></label>

                                    <input class="form-rating__input" id="star2-{{ $reservation['id'] }}" name="rating" type="radio" value="2" {{ (old('rating') == 2) ? 'checked' : ''}}>
                                    <label class="form-rating__star" for="star2-{{ $reservation['id'] }}"><i class="fa-solid fa-star"></i></label>

                                    <input class="form-rating__input" id="star1-{{ $reservation['id'] }}" name="rating" type="radio" value="1" {{ (old('rating') == 1) ? 'checked' : ''}}>
                                    <label class="form-rating__star" for="star1-{{ $reservation['id'] }}"><i class="fa-solid fa-star"></i></label>
                                </div>
                            </div>
                            <div class="error-message">
                                    @error('rating')
                                    {{ $message }}
                                    @enderror
                                </div>
                            <div class="form-rating__comment">
                                <textarea class="form-rating__comment-test" name="comment" rows="10" placeholder="コメントを入力してください">{{ old('comment') }}</textarea>
                            </div>
                            <div class="error-message">
                                @error('comment')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <button class="common-btn delete-btn" type="submit">投稿する</button>
                    </form>
                </div>
            </div>
            @endforeach
        </table>
    </div>
</div>

@endsection