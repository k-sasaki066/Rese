<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationForm extends Component
{
    public $option_times;
    public $option_numbers;
    public $shop;
    public $date;
    public $time;
    public $number;
    public $user_id;
    public $shop_id;
    public $min_date;
    public $max_date;
    protected $totals;

    public function mount()
    {
        $this->min_date = Carbon::now()->addDay()->format('Y-m-d');
        $this->max_date = Carbon::now()->addMonth(2)->format('Y-m-d');
    }
    // ReservationRequestを取得
    protected function rules(): array
    {
        return (new ReservationRequest())->rules();
    }

    protected function messages(): array
    {
        return (new ReservationRequest())->messages();
    }

    public function render()
    {

        return view('livewire.reservation-form');
    }

    // 各項目を入力次第バリデーションする
    public function updatedDate($date)
    {
        $this->validateOnly('date');
    }

    public function updatedTime($time)
    {
        $this->validateOnly('time');
    }

    public function updatedNumber($number)
    {
        $this->validateOnly('number');
    }

    // 予約処理
    public function reservation($shop_id)
    {
        $user_id = Auth::user()->id;
        $this->validate();
        
        // 店舗定休日を取得
        $holidays = unserialize($this->shop->holiday);
        // 入力データから曜日を取得
        $day = new Carbon($this->date);
        $compare = $day->isoFormat('ddd');
        // 店舗定休日に含まれているか判定
        $result = in_array($compare, $holidays);
        $isHoliday = $day->isHoliday();
        if($result == true) {
            return back()->withInput()->with('date', '定休日のため予約できません');
        }
        if(in_array('祝日', $holidays)) {
            if($isHoliday == true) {
            return back()->withInput()->with('date', '定休日のため予約できません');
        }
    }

        // 入力したデータに対してログインユーザーの予約状況を取得
        $user = Reservation::where('user_id', $user_id)
        ->where('date', $this->date)
        ->where('time', $this->time.':00')
        ->first();

        if($user !== null) {
            return back()->withInput()->with('result', '既に同じ時間帯で別の予約が成立しています。予約状況をご確認ください');
        }

        // 予約状況を取得（同日、同時間帯の合計人数を算出）
        $this->totals = DB::table('reservations')
        ->where('shop_id', $shop_id)
        ->where('date', $this->date)
        ->where('time', $this->time.':00')
        ->select('time')
        ->selectRaw('SUM(number) as actual_number')
        ->groupBy('time')
        ->first();

        // 予約可能人数を算出
        if($this->totals !== null) {
            $num = $this->shop->max_number - $this->totals->actual_number;
        } else {
            $num = $this->shop->max_number;
        }

        // 予約可能人数と入力データを比較
        if($num - $this->number >= 0) {
            Reservation::create([
                'user_id' => $user_id,
                'shop_id' => $shop_id,
                'date' => $this->date,
                'time' => $this->time,
                'number' => $this->number,
            ]);

        return redirect('user/done');

        }else {
        return back()->withInput()->with('result', '申し訳ございません。すでに予約でいっぱいのため別の日、別の時間帯をご利用ください');
        };
    }
}
