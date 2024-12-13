<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

class PaymentController extends Controller
{
    public function getPayment($reservation_id)
    {
        $reservation = Reservation::with('menu')->find($reservation_id);
        $total = $reservation['menu']['price'] * $reservation['number'];
        // dd($reservation);

        return view('user/payment', compact('reservation', 'total'));
    }

    public function charge(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));//シークレットキー

        try {
            $charge = Charge::create(array(
                'amount' => $request->amount,
                'currency' => 'jpy',
                'description' => 'Example charge',
                'source'=> $request->token,
            ));
            return redirect('/user/done')->with('result', '決済が完了しました！');

        } catch (Exception $e) {
            return back()->with('result', '決済に失敗しました！('. $e->getMessage() . ')');
        }
    }
}
