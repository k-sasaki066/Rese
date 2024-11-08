@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/detail.css')}}">
@endsection

@section('content')
<div class="store-detail__group">
    <div class="store-name__group">
        <a class="back__btn common-shadow" href="/">
            <
        </a>
        <h2 class="store-name__text">
            {{ $shop['name'] }}
        </h2>
    </div>

    <div class="store-img__item">
        <img class="store-img" src="{{ $shop['image_url'] }}" alt="店舗画像">
    </div>

    <div class="store-tag__group">
        <p class="store__area-tag">
            #{{ $shop['area']['name'] }}
        </p>
        <p class="store__genre-tag">
            #{{ $shop['genre']['name'] }}
        </p>
    </div>

    <p class="store-content__text">
        {{ $shop['detail'] }}
    </p>
</div>

@livewire('reservation-form', ['option_times'=>$option_times, 'option_numbers'=>$option_numbers, 'shop'=>$shop])

@endsection