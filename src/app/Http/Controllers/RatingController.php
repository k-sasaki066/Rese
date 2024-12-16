<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Rating;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function getHistory()
    {
        $counter = 1;
        $today = Carbon::now()->format('Y-m-d');
        $user_id = Auth::user()->id;
        $reservations = Reservation::with('shop', 'rating')->where('user_id', $user_id)
        ->whereDate('date', '<', $today)
        ->orderBy('date', 'desc')
        ->orderBy('time', 'desc')
        ->get();

        return view('user/visit-history', compact('counter', 'reservations'));
    }

    public function postRating(Request $request) {

        // ルールの設定
        $validator = Validator::make($request->all(), [
            'rating' => 'required | integer | min:1 | max:5',
            'comment' => 'required',
        ], $messages = [
            'rating.required' => '評価を選択してください',
            'rating.integer' => '評価は整数を指定してください',
            'rating.min' => '評価には1以上の数値を指定してください',
            'rating.max' => '評価には5以下の数値を指定してください',
            'comment.required' => 'コメントを入力してください',
        ]);

        // バリデーションエラー発生時にリダイレクトする
        if ($validator->fails()) {
                return redirect( '/history'.'#' .$request->reservation_id)
                ->withErrors($validator)
                ->withInput();
            }

            // バリデーション済みデータの取得
            $validated = $validator->validated();

            $user_id = Auth::user()->id;

        Rating::create([
            'shop_id'=>$request->shop_id,
            'user_id'=>$user_id,
            'reservation_id'=>$request->reservation_id,
            'rating'=>$validated['rating'],
            'comment'=>$validated['comment'],
        ]);

        return redirect('/history')->with('result', 'レビューを投稿しました');
    }
}
