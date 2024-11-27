<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Http\Requests\EditorRequest;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;

class EditorController extends Controller
{
    public function index() {
        $formatter = function($datetime){
            return $datetime->format('H:i');
        };

        $option_times = array_map($formatter, iterator_to_array(new DatePeriod(
            new DateTime('00:00:00'),
            new DateInterval('PT60M'),
            new DateTime('24:00:00')
        )));

        $areas = Area::all();
        $genres = Genre::all();

        $info = Auth::user()->shopRepresentative;
        // dd($info);
        if($info !== null) {
            $shop = Shop::find($info['shop_id']);
        }else {
            $shop = null;
        };

        return view('editor/store-editor-form', compact('option_times', 'areas', 'genres', 'shop'));
    }

    public function edit(EditorRequest $request) {

        $holiday = serialize($request->holiday);

        if(request('image_url')) {
            $original = $request->file('image_url')->getClientOriginalName();
            $image_name = Carbon::now()->format('Ymd_His').'_'.$original;
            request()->file('image_url')->move('storage/images', $image_name);
        }

        $info = Auth::user()->shopRepresentative;
        if($info == null) {
            Shop::create([
                'area_id'=>$request->area_id,
                'genre_id'=>$request->genre_id,
                'name'=>$request->name,
                'address'=>$request->address,
                'building'=>$request->building,
                'tel'=>$request->tel1.'-'.$request->tel2.'-'.$request->tel3,
                'opening_time'=>$request->opening_time,
                'closing_time'=>$request->closing_time,
                'holiday'=>$holiday,
                'max_number'=>$request->max_number,
                'budget'=>$request->budget,
                'image_url'=>$image_name,
                'detail'=>$request->detail,
            ]);
        }else {
            $shop_id = $info->shop_id;
            $shop = Shop::find($shop_id);

            $shop->update([
                'area_id'=>$request->area_id,
                'genre_id'=>$request->genre_id,
                'name'=>$request->name,
                'address'=>$request->address,
                'building'=>$request->building,
                'tel'=>$request->tel1.'-'.$request->tel2.'-'.$request->tel3,
                'opening_time'=>$request->opening_time,
                'closing_time'=>$request->closing_time,
                'holiday'=>$holiday,
                'max_number'=>$request->max_number,
                'budget'=>$request->budget,
                'image_url'=>$image_name,
                'detail'=>$request->detail,
            ]);

        }


        return redirect('/mypage')->with('result', '店舗情報を更新しました');
    }

    public function list() {
        $display = Carbon::now()->format('Y-m-d');
        $info = Auth::user()->shopRepresentative;

        if($info !== null) {
        $shop_id = $info->shop_id;
        $reservations = Reservation::with('user')->where('shop_id', $shop_id)->whereDate('date', $display)->orderBy('time', 'asc')->get();
        }else {
            $reservations = [];
        }
        
        return view('editor/reservation-list', compact('display', 'reservations'));
    }

    public function date(Request $request) {
        $info = Auth::user()->shopRepresentative;
        $date = Carbon::parse($request->display);
        $display = $request->display;
        
        if($request->has('previous-day')) {
            $display = $date->copy()->subDay()->format('Y-m-d');
        }

        if($request->has('next-day')) {
            $display = $date->copy()->addDay()->format('Y-m-d');
        }

        if($info !== null) {
        $shop_id = Auth::user()->shopRepresentative->shop_id;
        $reservations = Reservation::with('user')->where('shop_id', $shop_id)->whereDate('date', $display)->orderBy('time', 'asc')->simplePaginate(10);
        }else {
            $reservations = [];
        }

        return view('editor/reservation-list', compact('display', 'reservations'));
    }
}
