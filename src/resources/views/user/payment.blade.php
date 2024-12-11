@extends('layouts/app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/user/payment.css')}}">
@endsection

@section('content')
@if (session('result'))
    <div class="flash_success-message">
        {{ session('result') }}
    </div>
@endif

<div class="payment-detail__group common-shadow">
    <h3 class="payment-detail__heading">クレジットカード決済</h3>
    <div class="payment-detail__amount">
        <p class="payment-detail__amount-text">{{ $reservation['menu']['name'] ."　" .'¥' .number_format($reservation['menu']['price']) }} ✖️ {{ $reservation['number'] }}人</p>
        <p class="payment-detail__amount-total">
            合計 ¥{{ number_format($total) }}(税込)
        </p>

        <div class="payment-form__container">
            <form class="payment-form" action="/payment/{reservation_id}" method="post">
            @csrf
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="{{ config('services.stripe.key') }}"
                    data-amount="100"
                    data-name="お支払い画面"
                    data-label="決済する"
                    data-description=""
                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                    data-locale="auto"
                    data-currency="JPY">
                </script>
            </form>
        </div>
    </div>
</div>

@endsection