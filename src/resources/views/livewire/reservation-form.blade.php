<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    <div class="reservation__group common-shadow">
        <form class="reservation-form" action="/detail" wire:submit.prevent="reservation({{$shop['id']}})">
            @csrf
            <p class="reservation__title">
                予約
            </p>
            @if(!Auth::check())
            <p class="reservation__title-not-login">※予約機能を使用するにはログインが必要です</p>
            @endif

            <div class="reservation-form__item">
                <input class="reservation-form__date-input" type="date" name="date" value="{{ old('date')}}" min="{{ $min_date }}" max ="{{ $max_date }}" wire:model.live="date" @if(!Auth::check()) disabled @endif>
                <div class="error-message">
                    @error('date')
                    {{ $message }}
                    @enderror
                    @if (session('date'))
                    {{ session('date') }}
                    @endif
                </div>

                <div class="reservation-form__select">
                    <select class="reservation-form__input" name="time" wire:model.live="time" @if(!Auth::check()) disabled @endif>
                        <option value="">
                            来店時間を選択してください
                        </option>
                        @foreach($option_times as $option_time)
                        <option value="{{ $option_time }}" {{ old('time') }}==$option_time ? 'selected' : ''>{{ $option_time }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="error-message">
                    @error('time')
                    {{ $message }}
                    @enderror
                </div>
                
                <div class="reservation-form__select">
                    <select class="reservation-form__input" name="number" value="{{ old('number') }}" wire:model.live="number" @if(!Auth::check()) disabled @endif>
                        <option value="">
                            来店人数を選択してください
                        </option>
                        @foreach($option_numbers as $option_number)
                        <option value="{{ $option_number }}" {{ old('number') }}==$option_number ? 'selected' : ''>{{ $option_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="error-message">
                    @error('number')
                    {{ $message }}
                    @enderror
                </div>

                <div class="reservation-menu__group">
                    <p class="reservation-menu__heading">メニュー</p>
                    @if($shop['menus']->isEmpty())
                    <p>メニューの登録がありません</p>
                    @else
                    @foreach($shop['menus'] as $menu)
                    <div class="payment-form__item">
                        <input class="payment-form__name" type="radio" name="menu_name" value="{{ $menu['name'] }}" wire:model.live="menu_name">
                        <label class="payment-form__item-label" for="">{{ $menu['name']."　" .'¥' .number_format($menu['price']) }}</label>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="error-message">
                    @error('menu_name')
                    {{ $message }}
                    @enderror
                </div>

                <div class="reservation-payment__group">
                    <p class="reservation-payment__heading">支払い方法</p>
                    <div class="payment-form__item">
                        <input class="payment-form__name" type="radio" name="payment" value="現地決済" wire:model.live="payment">
                        <label class="payment-form__item-label" for="">現地決済</label>
                    </div>
                    <div class="payment-form__item">
                        <input class="payment-form__name" type="radio" name="payment" value="クレジットカード決済" wire:model.live="payment">
                        <label class="payment-form__item-label" for="">クレジットカード決済</label>
                    </div>
                </div>
                <div class="error-message">
                    @error('payment')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="reservation-confirm__group">
                <table class="reservation-confirm__table">
                    <tr class="reservation-confirm__table-row">
                        <th class="reservation-confirm__table-header">
                            Shop
                        </th>
                        <td class="reservation-confirm__table-item">
                            {{ $shop['name'] }}
                        </td>
                    </tr>

                    <tr class="reservation-confirm__table-row">
                        <th class="reservation-confirm__table-header">
                            Date
                        </th>
                        <td class="reservation-confirm__table-item">
                            {{ $date }}
                        </td>
                    </tr>

                    <tr class="reservation-confirm__table-row">
                        <th class="reservation-confirm__table-header">
                            Time
                        </th>
                        <td class="reservation-confirm__table-item">
                            {{ $time }}
                        </td>
                    </tr>

                    <tr class="reservation-confirm__table-row">
                        <th class="reservation-confirm__table-header">
                            Number
                        </th>
                        <td class="reservation-confirm__table-item">
                            {{ $number }}
                        </td>
                    </tr>

                    <tr class="reservation-confirm__table-row">
                        <th class="reservation-confirm__table-header">
                            Menu
                        </th>
                        <td class="reservation-confirm__table-item">
                            {{ $menu_name }}
                        </td>
                    </tr>

                    <tr class="reservation-confirm__table-row">
                        <th class="reservation-confirm__table-header">
                            支払い方法
                        </th>
                        <td class="reservation-confirm__table-item">
                            {{ $payment }}
                        </td>
                    </tr>
                </table>
            </div>

            @if (session('result'))
                <div class="flash_error-message">
                    {{ session('result') }}
                </div>
            @endif
            <button class="reservation-form__submit" type="submit" @if(!Auth::check() || $shop['menus']->isEmpty()) disabled @endif>
                予約する
            </button>
        </form>
    </div>
</div>
