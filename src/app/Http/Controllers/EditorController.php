<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Http\Requests\EditorRequest;
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

        return view('editor/store-editor-form', compact('option_times', 'areas', 'genres'));
    }

    public function edit(EditorRequest $request) {
        // dd($request);
        $storeForm = $request->all();
        $areaName = Area::find($storeForm['area_id']);

        return view('editor/confirm', compact('storeForm', 'areaName'));
    }

    public function list() {
        $display = Carbon::now()->format('Y-m-d');
        $reservations = Reservation::with('user')->where('shop_id', 1)->whereDate('date', $display)->orderBy('time', 'asc')->get();
        
        return view('editor/reservation-list', compact('display', 'reservations'));
    }

    public function date(Request $request) {
        $date = Carbon::parse($request->display);
        // dd($date);
        $display = $request->display;
        // dd($display);
        if($request->has('previous-day')) {
            $display = $date->copy()->subDay()->format('Y-m-d');
        }

        if($request->has('next-day')) {
            $display = $date->copy()->addDay()->format('Y-m-d');
        }

        $reservations = Reservation::with('user')->where('shop_id', 1)->whereDate('date', $display)->orderBy('time', 'asc')->simplePaginate(10);

        return view('editor/reservation-list', compact('display', 'reservations'));
    }
}
