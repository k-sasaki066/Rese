@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store-editor/store-editor-form.css')}}">
@endsection

@section('content')
<div class="store-edit__group">
    <h2 class="store-edit__heading">
        店舗情報作成・更新
    </h2>
    <form class="store-edit__form" action="post" method="">
        @csrf
        <table class="store-edit__table">
            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    店舗名<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input" type="text" name="name"
                    value="" placeholder="店舗名">
                    <div class="error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                    <!-- error-message -->
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    住所<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input" type="text" name="address" 
                    value="" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
                    <div class="error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                    <!-- error-message -->
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    建物名<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input" type="text" name="building" 
                    value="" placeholder="例：千駄ヶ谷ビル1F">
                    <div class="error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                    <!-- error-message -->
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    電話番号<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item store-edit__tel">
                    <input class="store-edit__input" type="tel" name="tel1" 
                    value="" placeholder="例：012">
                    <span>-</span>
                    <input class="store-edit__input" type="tel" name="tel2" 
                    value="" placeholder="例：345">
                    <span>-</span>
                    <input class="store-edit__input" type="tel" name="tel3" 
                    value="" placeholder="例：6789">
                    <div class="error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                    <!-- error-message -->
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    営業時間<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item store-edit__time">
                    <div class="store-edit__select-inner">
                        <select class="store-edit__select" name="opening_time" id="">
                            <option value="">選択してください</option>
                        </select>
                    </div>
                    <span>~</span>
                    <div class="store-edit__select-inner">
                        <select class="store-edit__select" name="closing_time" id="">
                            <option value="">選択してください</option>
                        </select>
                    </div>
                    <div class="error-message">
                    @if ($errors->has('opening_time'))
                    {{$errors->first('opening_time')}}
                    @else 
                    {{$errors->first('closing_time')}}
                    @endif
                    <!-- error-message -->
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    定休日<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item store-edit__holiday">
                    <label class="store-edit__holiday-label" for="mon">
                        <input class="store-edit__day-input" type="checkbox" name="holiday" id="mon" value="1">
                        <span class="store-edit__day-text">月</span>
                    </label>

                    <label class="store-edit__holiday-label" for="tue">
                        <input class="store-edit__day-input" type="checkbox" name="holiday" id="tue" value="2">
                        <span class="store-edit__day-text">火</span>
                    </label>

                    <label class="store-edit__holiday-label" for="wed">
                        <input class="store-edit__holiday-input" type="checkbox" name="holiday" id="wed" value="3">
                        <span class="store-edit__day-text">水</span>
                    </label>

                    <label class="store-edit__holiday-label" for="thu">
                        <input class="store-edit__day-input" type="checkbox" name="holiday" id="thu" value="4">
                        <span class="store-edit__day-text">木</span>
                    </label>

                    <label class="store-edit__holiday-label" for="fri">
                        <input class="store-edit__day-input" type="checkbox" name="holiday" id="fri" value="5">
                        <span class="store-edit__day-text">金</span>
                    </label>

                    <label class="store-edit__holiday-label" for="sat">
                        <input class="store-edit__day-input" type="checkbox" name="holiday" id="sat" value="6">
                        <span class="store-edit__day-text">土</span>
                    </label>

                    <label class="store-edit__holiday-label" for="sun">
                        <input class="store-edit__day-input" type="checkbox" name="holiday" id="sun" value="7">
                        <span class="store-edit__day-text">日</span>
                    </label>

                    <label class="store-edit__holiday-label" for="national">
                        <input class="store-edit__day-input" type="checkbox" name="holiday" id="national" value="8">
                        <span class="store-edit__day-text">祝日</span>
                    </label>

                    <label class="store-edit__holiday-label" for="all-open">
                        <input class="store-edit__day-input" type="checkbox" name="holiday" id="all-open" value="9">
                        <span class="store-edit__day-text">年中無休</span>
                    </label>
                    <div class="error-message">
                    @error('holiday')
                    {{ $message }}
                    @enderror
                    <!-- error-message -->
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    予約最大人数<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input store-edit__number" type="text" name="max_number" 
                    value="">
                    <span>人</span>
                    <div class="error-message">
                    @error('max_number')
                    {{ $message }}
                    @enderror
                    <!-- error-message -->
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    予算<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input store-edit__budget" type="text" name="budget" 
                    value="">
                    <span>円</span>
                    <div class="error-message">
                    @error('budget')
                    {{ $message }}
                    @enderror
                    <!-- error-message -->
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    店舗画像<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input" type="file" name="image_url" 
                    value="">
                    <div class="error-message">
                    @error('image_url')
                    {{ $message }}
                    @enderror
                    <!-- error-message -->
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    エリア<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item ">
                    <div class="store-edit__select-inner">
                        <select class="store-edit__select store-edit__area" name="area_id" id="">
                            <option value="">選択してください</option>
                        </select>
                    </div>
                    <div class="error-message">
                    @error('area_id')
                    {{ $message }}
                    @enderror
                    <!-- error-message -->
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    ジャンル<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <div class="store-edit__select-inner">
                        <select class="store-edit__select store-edit__genre" name="genre_id" id="">
                            <option value="">選択してください</option>
                        </select>
                    </div>
                    <div class="error-message">
                    @error('genre_id')
                    {{ $message }}
                    @enderror
                    <!-- error-message -->
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    説明<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <textarea class="store-edit__textarea" name="detail" rows="10"></textarea>
                    <div class="error-message">
                    @error('detail')
                    {{ $message }}
                    @enderror
                    <!-- error-message -->
                    </div>
                </td>
            </tr>
        </table>
    <button class="store-edit__btn common-btn">確認画面へ</button>
    </form>
</div>
@endsection