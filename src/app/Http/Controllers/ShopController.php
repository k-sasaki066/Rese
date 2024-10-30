<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

class ShopController extends Controller
{
    public function index(){
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::with(['area', 'genre'])
        ->get();
        // dd($areas);

        return view('user/index', compact('shops', 'areas', 'genres'));
    }

    public function detail($shop_id){
        // dd($shop_id);
        $shop = Shop::with(['area', 'genre'])
        ->find($shop_id);
        // dd($shop);

        return view('user/detail', compact('shop'));
    }

    public function getMypage()
    {
        return view('user/mypage');
    }
}
