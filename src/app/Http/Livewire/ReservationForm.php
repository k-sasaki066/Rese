<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;

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

    public function updated()
    {
        $this->validate();
    }

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
