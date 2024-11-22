@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/editor/confirm.css')}}">
<link rel="stylesheet" href="{{ asset('css/editor/store-editor-form.css')}}">
@endsection

@section('content')
<div class="store-confirm__group">
    <h2 class="store-confirm__heading">
        Confirm
    </h2>
    <form class="store-confirm__form" action="store/confirm" method="post">
        @csrf
        <table class="store-confirm__table">
            <tr class="store-confirm__table-row">
                <th class="store-confirm__table-heading">
                    店舗名
                </th>
                <td class="store-confirm__table-item">
                    <input class="store-confirm__input" type="text" name="name"
                    value="{{ $storeForm['name'] }}" readonly>
                </td>
            </tr>

            <tr class="store-confirm__table-row">
                <th class="store-confirm__table-heading">
                    住所
                </th>
                <td class="store-confirm__table-item">
                    <input class="store-confirm__input" type="text" name="address" value="{{ $storeForm['address'] }}" readonly>
                </td>
            </tr>

            <tr class="store-confirm__table-row">
                <th class="store-confirm__table-heading">
                    建物名
                </th>
                <td class="store-confirm__table-item">
                    <input class="store-confirm__input" type="text" name="building" value="@if($storeForm['building']){{ $storeForm['building'] }} @else - @endif" readonly>
                </td>
            </tr>

            <tr class="store-confirm__table-row">
                <th class="store-confirm__table-heading">
                    電話番号
                </th>
                <td class="store-confirm__table-item">
                    <input class="store-confirm__input" type="tel" name="tel"
                    value="{{ $storeForm['tel1'] }}-{{ $storeForm['tel2'] }}-{{ $storeForm['tel3'] }}" readonly>
                    </div>
                </td>
            </tr>

            <tr class="store-confirm__table-row">
                <th class="store-confirm__table-heading">
                    営業時間
                </th>
                <td class="store-confirm__table-item">
                    <input class="store-confirm__input" type="text" name="opening_time"
                    value="{{ $storeForm['opening_time'] }}~{{ $storeForm['closing_time'] }}" readonly>
                </td>
            </tr>

            <tr class="store-confirm__table-row">
                <th class="store-confirm__table-heading">
                    定休日
                </th>
                <td class="store-confirm__table-item">
                    <input class="store-confirm__input" type="text" name="holiday"
                    value="@foreach($storeForm['holiday'] as $holiday){{ $holiday }} @endforeach" readonly>
                </td>
            </tr>

            <tr class="store-confirm__table-row">
                <th class="store-confirm__table-heading">
                    席数
                </th>
                <td class="store-confirm__table-item">
                    <input class="store-confirm__input" type="text" name="max_number"
                    value="{{ $storeForm['max_number'] }}席" readonly>
                </td>
            </tr>

            <tr class="store-confirm__table-row">
                <th class="store-confirm__table-heading">
                    平均予算
                </th>
                <td class="store-confirm__table-item">
                    <input class="store-confirm__input" type="text" name="budget" value="{{ $storeForm['budget'] }}円" readonly>
                </td>
            </tr>

            <tr class="store-confirm__table-row">
                <th class="store-confirm__table-heading">
                    店舗画像
                </th>
                <td class="store-confirm__table-item">
                    <input class="store-confirm__input" type="file" name="image_url" value="{{ $storeForm['image_url'] }}">
                </td>
            </tr>

            <tr class="store-confirm__table-row">
                <th class="store-confirm__table-heading">
                    エリア
                </th>
                <td class="store-confirm__table-item">
                    <input class="store-confirm__input" type="text" name="area_id" value="{{ $areaName['name'] }}" readonly>
                </td>
            </tr>

            <tr class="store-confirm__table-row">
                <th class="store-confirm__table-heading">
                    ジャンル
                </th>
                <td class="store-confirm__table-item">
                    <input class="store-confirm__input" type="text" name="genre_id" value="{{ $storeForm['genre_id'] }}" readonly>
                </td>
            </tr>

            <tr class="store-confirm__table-row">
                <th class="store-confirm__table-heading">
                    説明
                </th>
                <td class="store-confirm__table-item">
                    <textarea class="store-confirm__textarea" name="detail" readonly>{{ $storeForm['detail'] }}</textarea>
                </td>
            </tr>
        </table>
        <button class="store-edit__btn common-btn" type="submit">保存</button>
    </form>
</div>
@endsection