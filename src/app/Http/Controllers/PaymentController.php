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

    public function postCharge(Request $request, $total)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        //シークレットキー
        $user = Auth::user();

        if (!$user->stripe_id) {
            $user->createAsStripeCustomer();
        }

        try {
            \Stripe\Charge::create([
                'source' => $request->stripeToken,
                'amount' => $total,
                'currency' => 'jpy',
                'description' => 'Example charge',
            ]);
            return redirect('/user/done')->with('result', '決済が完了しました！');

        } catch(\Stripe\Exception\CardException $e) {
        $result = 2;
        $error =  $e->getError()->message;

        // ②APIへのリクエストが早く、多すぎる
        }  catch (\Stripe\Exception\RateLimitException $e) {
        $result = 3;
        $error =  $e->getError()->message;

        // ③パラメータが無効
        } catch (\Stripe\Exception\InvalidRequestException $e) {
        $result = 4;
        $error =  $e->getError()->message;

        // ④STRIPE APIの認証に失敗（最近APIキーを変更した場合など）
        } catch (\Stripe\Exception\AuthenticationException $e) {
        $result = 5;
        $error =  $e->getError()->message;
        
        // ⑤Stripeとのネットワークコミュニケーションに失敗
        } catch (\Stripe\Exception\ApiConnectionException $e) {
        $result = 6;
        $error =  $e->getError()->message;

        // ⑥一般的なエラー
        } catch (\Stripe\Exception\ApiErrorException $e) {
        $result = 7;
        $error =  $e->getError()->message;

        // ⑦Stripeと関係のないエラー
        } catch (Exception $e) {
        $result = 8;
        $error =  $e->getError()->message;
        }
        
        if($result==2) {
        return redirect()->back()->with('result', '入力いただいたカードでは、お支払いができませんでした。再度お試しいただくか、または他のカードでお試しください。');
        }elseif($result==3) {
        return redirect()->back()->with('result', 'APIエラーです。');
        }elseif($result==4) {
        return redirect()->back()->with('result', 'パラメータが無効です。');
        }elseif($result==5) {
        return redirect()->back()->with('result', '認証に失敗しました。');
        }elseif($result==6) {
        return redirect()->back()->with('result', '通信エラーです。');
        }elseif($result==7) {
        return redirect()->back()->with('result', 'エラーが起こりました。');
        }elseif($result==8) {
        return redirect()->back()->with('result', 'エラーが起こりました。');
        }
    }
}
