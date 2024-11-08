<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Http\Requests\ReservationRequest;

class ShopController extends Controller
{
    public function index() {
        return view('user/index');
    }

    public function detail($shop_id){
        // dd($shop_id);
        $shop = Shop::with(['area', 'genre'])
        ->find($shop_id);
        // dd($shop);

        for($i=1; $i <= $shop['max_number'] ; $i++) {
            $option_numbers[] = $i;
        }
        
        $open = substr($shop['opening_time'], 0, 2);
        $close = substr($shop['closing_time'], 0, 2);
        for($t=$open; $t < $close; $t++) {
            $option_times[] = $t.':00';
        }
        // dd($times);
        return view('user/detail', compact('shop', 'option_numbers', 'option_times'));
    }

    public function done()
    {
        return view('user/done');
    }

    public function getMypage()
    {
        return view('user/mypage');
    }
}
