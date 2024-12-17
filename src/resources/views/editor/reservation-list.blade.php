@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/editor/reservation-list.css')}}">
@endsection

@section('content')
<div class="reservation-list__group">
    <h1 class="reservation-list__heading">
        Reservation-list
    </h1>
    <form class="reservation-list__date-form" action="/editor/shop/date" method="get">
        @csrf
        <button class="date-change__button" name="previous-day"> < </button>
        <input type="hidden" name="display" value="{{ $display }}">
        <h2 class="date-form__header">
            {{ $display }}
        </h2>
        <button class="date-change__button" name="next-day"> > </button>
    </form>
    <div class="reservation-list__table-container">
        <table class="reservation-list__table">
            <tr class="reservation-list__table-row">
                <th class="reservation-list__table-heading">
                    No.
                </th>
                <th class="reservation-list__table-heading">
                    Time
                </th>
                <th class="reservation-list__table-heading">
                    Name
                </th>
                <th class="reservation-list__table-heading">
                    Number
                </th>
                <th class="reservation-list__table-heading">
                    Menu
                </th>
                <th class="reservation-list__table-heading">
                    Payment
                </th>
                <th class="reservation-list__table-heading">
                    Status
                </th>
            </tr>
            @if(empty($reservations) || $reservations -> isEmpty())
                <tr class="reservation-list__table-row">
                    <td class="date-table__item-empty" colspan="7">
                        該当データはありません
                    </td>
                </tr>
            @else

            @php
                $list_item = 1;
            @endphp

            @foreach($reservations as $reservation)
            <tr class="reservation-list__table-row">
                <td class="reservation-list__table-item">
                    {{ $list_item }}
                </td>
                <td class="reservation-list__table-item">
                    {{ substr($reservation['time'], 0,5) }}
                </td>
                <td class="reservation-list__table-item">
                    {{ $reservation['user']['name'] }}
                </td>
                <td class="reservation-list__table-item">
                    {{ $reservation['number'] }}
                </td>
                <td class="reservation-list__table-item">
                    {{ $reservation['menu']['name'] }}
                </td>
                <td class="reservation-list__table-item">
                    @if($reservation['payment'] == 1)
                    現地決済
                    @else
                    クレジットカード決済
                    @endif
                </td>
                <td class="reservation-list__table-item">
                    @if($reservation['status'] == 1)
                    予約
                    @else
                    来店
                    @endif
                </td>
            </tr>

            @php
                $list_item+=1;
            @endphp

            @endforeach
            @endif
        </table>
    </div>
</div>
@endsection