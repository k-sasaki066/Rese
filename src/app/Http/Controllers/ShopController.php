<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Rating;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;

class ShopController extends Controller
{
    public function index() {
        return view('user/index');
    }

    public function getDetail($shop_id){
        $shop = Shop::with(['area', 'genre', 'menus'])
        ->find($shop_id);
        $holidays = unserialize($shop->holiday);

        for($i=1; $i <= $shop['max_number'] ; $i++) {
            $option_numbers[] = $i;
        }

        $formatter = function($datetime){
            return $datetime->format('H:i');
        };

        $option_times = array_map($formatter, iterator_to_array(new DatePeriod(
            new DateTime($shop['opening_time']),
            new DateInterval('PT60M'),
            new DateTime($shop['closing_time'])
        )));

        $prev = url()->previous();

        $record = Rating::with('reservation', 'user')->where('shop_id', $shop_id)->orderBy('created_at', 'desc');
        $ratings = $record->get();
        $rating_count = $record->count();

        return view('user/detail', compact('shop', 'option_numbers', 'option_times', 'prev', 'holidays', 'ratings', 'rating_count'));
    }

    public function done()
    {
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
            $today = Carbon::now()->format('Y-m-d');
            $reservations = Reservation::with('shop')
            ->where('user_id', $user_id)
            ->whereDate('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

            $shops = Shop::with('area', 'genre', 'favorites')
            ->leftJoin('ratings', 'shops.id', '=', 'ratings.shop_id')
            ->select(
                'shops.id',
                'area_id',
                'genre_id',
                'name',
                'image_url',
            )
            ->selectRaw(
                'AVG(rating) as rating_avg'
            )
            ->groupBy(
                'shops.id',
                'area_id',
                'genre_id',
                'name',
                'image_url',
            )
            ->get(['shops.*']);

            $counter = 1;

            return view('user/mypage', compact('reservations', 'shops', 'counter', 'today'));
        }
    }

    public function delete($reservation_id)
    {
        $reservation = Reservation::find($reservation_id)->delete();

        return redirect('/mypage')->with('result', '予約をキャンセルしました');
    }

    public function reservationConfirm($reservation_id)
    {
        $reservation = Reservation::with('user')->find($reservation_id);
        $reservation->status = '2';
        $reservation->save();

        return view('editor/visit-confirm', compact('reservation'));
    }
}
