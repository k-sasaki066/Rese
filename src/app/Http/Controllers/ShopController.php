<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DatePeriod;
use DateInterval;

class ShopController extends Controller
{
    public function index() {
        return view('user/index');
    }

    public function detail($shop_id){
        $shop = Shop::with(['area', 'genre'])
        ->find($shop_id);

        // 店舗ごとの予約可能人数取得
        for($i=1; $i <= $shop['max_number'] ; $i++) {
            $option_numbers[] = $i;
        }

        // 予約可能時間を30分間隔で取得
        $formatter = function($datetime){
            return $datetime->format('H:i');
        };

        $option_times = array_map($formatter, iterator_to_array(new DatePeriod(
            new DateTime($shop['opening_time']),
            new DateInterval('PT60M'),
            new DateTime($shop['closing_time'])
        )));

        // 直前のurlを取得
        $prev = url()->previous();

        return view('user/detail', compact('shop', 'option_numbers', 'option_times', 'prev'));
    }

    public function done()
    {
        // 直前のurlを取得
        $prev = url()->previous();

        return view('user/done', compact('prev'));
    }

    public function getMypage()
    {
        if(Auth::user()->hasRole('admin')) {
            return view('admin/admin-menu');
        }elseif(Auth::user()->hasRole('editor')) {
            return view('editor/editor-menu');
        }else {
            $user_id = Auth::user()->id;
            $reservations = Reservation::with('shop')->where('user_id', $user_id)->orderBy('date', 'asc')->get();

            $shops = Shop::with(['area', 'genre','favorites'])
            ->get();

            $counter = 1;

            return view('user/mypage', compact('reservations', 'shops', 'counter'));
        }
    }

    public function delete($reservation_id)
    {
        $reservation = Reservation::find($reservation_id)->delete();

        return redirect('/mypage')->with('result', '予約をキャンセルしました');
    }

}
