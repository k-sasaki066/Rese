<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use App\Models\shop;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;

class ReservationEdit extends Component
{
    public $reservation;
    public $reservation_id;
    public $shop;
    public $option_numbers = [];
    public $option_times = [];
    public $date;
    public $time;
    public $number;
    public $min_date;
    public $max_date;

    public function mount()
    {
        $this->date = $this->reservation->date;
        $this->time = substr($this->reservation->time, 0, 5);
        $this->number = $this->reservation->number;

        $shop_id = $this->reservation->shop_id;
        $this->shop = Shop::find($shop_id);

        // 店舗ごとの予約可能人数取得
        for($i=1; $i <= $this->shop['max_number'] ; $i++) {
            $this->option_numbers[] = $i;
        }

        // 予約可能時間を30分間隔で取得
        $formatter = function($datetime){
            return $datetime->format('H:i');
        };

        $this->option_times = array_map($formatter, iterator_to_array(new DatePeriod(
            new DateTime($this->shop['opening_time']),
            new DateInterval('PT60M'),
            new DateTime($this->shop['closing_time'])
        )));

        $this->min_date = Carbon::now()->addDay()->format('Y-m-d');
        $this->max_date = Carbon::now()->addMonth(2)->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.reservation-edit');
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

    // 予約情報更新処理
    public function update($reservation_id)
    {
        $user_id = Auth::user()->id;
        $this->validate();
        Reservation::find($reservation_id)
        ->update([
            'date' => $this->date,
            'time' => $this->time,
            'number' => $this->number,
        ]);

        return redirect('/mypage')->with('result', '予約情報を更新しました');
    }

}
