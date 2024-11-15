<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        Reservation::create([
            'user_id' => $user_id,
            'shop_id' => $shop_id,
            'date' => $this->date,
            'time' => $this->time,
            'number' => $this->number,
        ]);

        return redirect('user/done');
    }
}
