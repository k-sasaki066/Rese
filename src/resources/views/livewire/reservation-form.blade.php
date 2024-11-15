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
                </table>
            </div>
            <button class="reservation-form__submit" type="submit" @if(!Auth::check()) disabled @endif>
                予約する
            </button>
        </form>
    </div>
</div>
