<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Rating;
use App\Models\Reservation;
use App\Http\Requests\RatingRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RatingController extends Controller
{
    public function history()
    {
        $counter = 1;
        $today = Carbon::now()->format('Y-m-d');
        $user_id = Auth::user()->id;
        $reservations = Reservation::with('shop', 'rating')->where('user_id', $user_id)
        ->whereDate('date', '<', $today)
        ->orderBy('date', 'asc')
        ->orderBy('time', 'asc')
        ->get();

        return view('user/visit-history', compact('counter', 'reservations'));
    }

    public function postRating(RatingRequest $request) {
        $user_id = Auth::user()->id;

        Rating::create([
            'shop_id'=>$request->shop_id,
            'user_id'=>$user_id,
            'reservation_id'=>$request->reservation_id,
            'rating'=>$request->rating,
            'comment'=>$request->comment,
        ]);

        return redirect('/user/history')->with('result', 'レビューを投稿しました');
    }
}
