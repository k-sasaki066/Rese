@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/editor/store-editor-form.css')}}">
@endsection

@section('content')
<div class="store-edit__group">
    <h2 class="store-edit__heading">
        店舗情報作成・更新
    </h2>
    <form class="store-edit__form" action="/editor/shop/edit" method="post" enctype="multipart/form-data">
        @csrf
        <table class="store-edit__table">
            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    店舗名<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input" type="text" name="name"
                    value="{{ ($shop == null) ? old('name') : $shop->name }}" placeholder="店舗名">
                    <div class="error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    住所<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input" type="text" name="address" value="{{ ($shop == null) ? old('address') : $shop->address }}" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
                    <div class="error-message">
                    @error('address')
                    {{ $message }}
                    @enderror
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    建物名
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input" type="text" name="building" value="{{ ($shop == null) ? old('building') : $shop->building }}" placeholder="例：千駄ヶ谷ビル1F">
                    <div class="error-message">
                    @error('building')
                    {{ $message }}
                    @enderror
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    電話番号<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <div class="store-edit__tel">
                        <input class="store-edit__input" type="tel" name="tel" value="{{ ($shop == null) ? old('tel') : $shop->tel }}"" placeholder="例：012-345-6789">
                    </div>
                    <div class="error-message">
                    @error('tel')
                    {{ $message }}
                    @enderror
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    営業時間<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <div class="store-edit__time">
                        <div class="store-edit__select-inner">
                            <select class="store-edit__select" name="opening_time" id="">
                                <option value="">選択してください</option>
                                @foreach($option_times as $option_time)
                                    <option value="{{ $option_time }}" @if($shop !== null){{ substr($shop->opening_time, 0,5)==$option_time ? 'selected' : '' }}@else {{ old('opening_time')==$option_time ? 'selected' : '' }}@endif>{{ $option_time }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span>~</span>
                        <div class="store-edit__select-inner">
                            <select class="store-edit__select" name="closing_time" id="">
                                <option value="">選択してください</option>
                                @foreach($option_times as $option_time)
                                    <option value="{{ $option_time }}" @if($shop !== null){{ substr($shop->closing_time, 0,5)==$option_time ? 'selected' : '' }}>{{ $option_time }}@else {{ old('closing_time')==$option_time ? 'selected' : '' }}>{{ $option_time }}@endif</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="error-message">
                    @if ($errors->has('opening_time'))
                    {{$errors->first('opening_time')}}
                    @else
                    {{$errors->first('closing_time')}}
                    @endif
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    定休日<span class="store-edit__required">※</span>
                </th>
                @if($shop !== null)
                @php
                $holiday = unserialize($shop->holiday);
                @endphp
                @endif
                <td class="store-edit__table-item">
                    <div class="store-edit__holiday">
                        <label class="store-edit__holiday-label" for="mon">
                            <input class="store-edit__day-input" type="checkbox" name="holiday[]" id="mon" value="月"  @if($shop !== null){{in_array('月', $holiday) ? 'checked' : ''}}@else {{ (is_array(old('holiday')) && in_array('月', old('holiday'))) ? 'checked' : '' }} @endif>
                            <span class="store-edit__day-text">月</span>
                        </label>

                        <label class="store-edit__holiday-label" for="tue">
                            <input class="store-edit__day-input" type="checkbox" name="holiday[]" id="tue" value="火" @if($shop !== null){{in_array('火', $holiday) ? 'checked' : ''}} @else {{ (is_array(old('holiday')) && in_array('火', old('holiday'))) ? 'checked' : '' }}@endif>
                            <span class="store-edit__day-text">火</span>
                        </label>

                        <label class="store-edit__holiday-label" for="wed">
                            <input class="store-edit__holiday-input" type="checkbox" name="holiday[]" id="wed" value="水" @if($shop !== null){{in_array('水', $holiday) ? 'checked' : ''}} @else {{ (is_array(old('holiday')) && in_array('水', old('holiday'))) ? 'checked' : '' }}@endif>
                            <span class="store-edit__day-text">水</span>
                        </label>

                        <label class="store-edit__holiday-label" for="thu">
                            <input class="store-edit__day-input" type="checkbox" name="holiday[]" id="thu" value="木" @if($shop !== null){{in_array('木', $holiday) ? 'checked' : ''}} @else {{ (is_array(old('holiday')) && in_array('木', old('holiday'))) ? 'checked' : '' }} @endif>
                            <span class="store-edit__day-text">木</span>
                        </label>

                        <label class="store-edit__holiday-label" for="fri">
                            <input class="store-edit__day-input" type="checkbox" name="holiday[]" id="fri" value="金" @if($shop !== null){{in_array('金', $holiday) ? 'checked' : ''}} @else {{ (is_array(old('holiday')) && in_array('金', old('holiday'))) ? 'checked' : '' }}@endif>
                            <span class="store-edit__day-text">金</span>
                        </label>

                        <label class="store-edit__holiday-label" for="sat">
                            <input class="store-edit__day-input" type="checkbox" name="holiday[]" id="sat" value="土" @if($shop !== null){{in_array('土', $holiday) ? 'checked' : ''}} @else {{ (is_array(old('holiday')) && in_array('土', old('holiday'))) ? 'checked' : '' }} @endif>
                            <span class="store-edit__day-text">土</span>
                        </label>

                        <label class="store-edit__holiday-label" for="sun">
                            <input class="store-edit__day-input" type="checkbox" name="holiday[]" id="sun" value="日" @if($shop !== null){{in_array('日', $holiday) ? 'checked' : ''}} @else {{ (is_array(old('holiday')) && in_array('日', old('holiday'))) ? 'checked' : '' }}@endif>
                            <span class="store-edit__day-text">日</span>
                        </label>

                        <label class="store-edit__holiday-label" for="national">
                            <input class="store-edit__day-input" type="checkbox" name="holiday[]" id="national" value="祝日" @if($shop !== null){{in_array('祝日', $holiday) ? 'checked' : ''}} @else {{ (is_array(old('holiday')) && in_array('祝日', old('holiday'))) ? 'checked' : '' }}@endif>
                            <span class="store-edit__day-text">祝日</span>
                        </label>

                        <label class="store-edit__holiday-label" for="all-open">
                            <input class="store-edit__day-input" type="checkbox" name="holiday[]" id="all-open" value="無休" @if($shop !== null){{in_array('無休', $holiday) ? 'checked' : ''}} @else {{ (is_array(old('holiday')) && in_array('無休', old('holiday'))) ? 'checked' : '' }}@endif>
                            <span class="store-edit__day-text">年中無休</span>
                        </label>
                    </div>
                    <div class="error-message">
                    @error('holiday')
                    {{ $message }}
                    @enderror
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    席数<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input store-edit__number" type="text" name="max_number" value="{{ ($shop == null) ? old('max_number') : $shop->max_number }}">
                    <span>席</span>
                    <div class="error-message">
                    @error('max_number')
                    {{ $message }}
                    @enderror
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    平均予算<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <input class="store-edit__input store-edit__budget" type="text" name="budget" value="{{ ($shop == null) ? old('budget') : $shop->budget }}">
                    <span>円</span>
                    <div class="error-message">
                    @error('budget')
                    {{ $message }}
                    @enderror
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    店舗画像<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    @if($shop == null)
                    <input class="store-edit__input" type="file" name="image_url" value="{{ ($shop == null) ? old('image_url') : $shop->image_url }}">
                    @else
                    <div class="store-registration__group">
                        <div class="store-registration__img-group">
                            <p class="store-registration__img-text">現在登録している画像</p>
                            <div class="store-registration__img-container">
                                <img class="store-registration__img" src="{{$shop->image_url}}" alt="">
                            </div>
                        </div>
                        <div class="store-registration__change">
                            <p class="store-registration__change-text">画像を変更する場合はこちらから</p>
                            <input class="store-edit__input" type="file" name="change" value="{{ old('change') }}">
                        </div>
                    </div>
                    @endif
                    <div class="error-message">
                    @error('image_url')
                    {{ $message }}
                    @enderror
                    @if (session('img'))
                    {{ session('img') }}
                    @endif
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
                            <option value="" selected disabled>選択してください</option>
                            @foreach($areas as $area)
                                <option value="{{ $area['id'] }}" @if($shop !== null){{ $shop->area_id==$area['id'] ? 'selected' : '' }}>{{ $area['name'] }}@else{{ old('area_id')==$area['id'] ? 'selected' : '' }}>{{ $area['name'] }}@endif</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="error-message">
                    @error('area_id')
                    {{ $message }}
                    @enderror
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
                            @foreach($genres as $genre)
                                <option value="{{ $genre['id'] }}" @if($shop !== null){{ $shop->genre_id==$genre['id'] ? 'selected' : '' }}>{{ $genre['name'] }}@else{{ old('genre_id')==$genre['id'] ? 'selected' : '' }}>{{ $genre['name'] }}@endif</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="error-message">
                    @error('genre_id')
                    {{ $message }}
                    @enderror
                    </div>
                </td>
            </tr>

            <tr class="store-edit__table-row">
                <th class="store-edit__table-heading">
                    説明<span class="store-edit__required">※</span>
                </th>
                <td class="store-edit__table-item">
                    <textarea class="store-edit__textarea" name="detail" rows="10">{{ ($shop == null) ? old('detail') : $shop->detail }}</textarea>
                    <div class="error-message">
                    @error('detail')
                    {{ $message }}
                    @enderror
                    </div>
                </td>
            </tr>
        </table>
        <div class="store-edit__btn-group">
            <a class="store-edit__btn" href="#editor">保存</a>
        </div>

        <div class="modal__group" id="editor">
            <a class="modal-overlay" href="#!"></a>
            <div class="modal__inner">
                <div class="close-detail__modal">
                    <a href="#!" class="close-detail__button"><img class="close-detail__button-img" src="../../images/close-btn.svg" alt="閉じる"></a>
                </div>
                <div class="modal__content">
                    <p class="modal__content-text">店舗情報を更新します。よろしいですか？</p>
                    <button class="common-btn modal-btn" type="submit">更新</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection