<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use App\Models\shop;
use App\Http\Requests\ReservationEditRequest;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
    public $user;
    protected $totals;

    public function mount()
    {
        $this->date = $this->reservation->date;
        $this->time = substr($this->reservation->time, 0, 5);
        $this->number = $this->reservation->number;

        $shop_id = $this->reservation->shop_id;
        $this->shop = Shop::find($shop_id);

        for($i=1; $i <= $this->shop['max_number'] ; $i++) {
            $this->option_numbers[] = $i;
        }

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

    protected function rules(): array
    {
        return (new ReservationEditRequest())->rules();
    }

    protected function messages(): array
    {
        return (new ReservationEditRequest())->messages();
    }

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

    public function update($reservation_id)
    {
        $user_id = Auth::user()->id;
        $this->validate();

        $this->totals = DB::table('reservations')
            ->where('shop_id', $this->shop->id)
            ->where('date', $this->date)
            ->where('time', $this->time.':00')
            ->select('time')
            ->selectRaw('SUM(number) as actual_number')
            ->groupBy('time')
            ->first();

        if($this->reservation->date == $this->date && substr($this->reservation->time,0,5) == $this->time && $this->reservation->number !== $this->number) {
            if($this->totals !== null) {
                $num = (($this->shop->max_number - $this->totals->actual_number) + $this->reservation->number);
            } else {
                $num = $this->shop->max_number;
            }

        } elseif($this->reservation->date == $this->date && substr($this->reservation->time,0,5) == $this->time && $this->reservation->number == $this->number){
            return back()->withInput();

        } else{
            $this->user = Reservation::where('user_id', $user_id)
            ->where([['date', '!=', $this->reservation->date], ['time', '!=', $this->reservation->time.':00']])
            ->where('date', $this->date)
            ->where('time', $this->time.':00')
            ->exists();

            $holidays = unserialize($this->shop->holiday);
            $day = new Carbon($this->date);
            $compare = $day->isoFormat('ddd');

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

            if($this->user == true) {
                return back()->withInput();
            }

            if($this->totals !== null) {
                $num = $this->shop->max_number - $this->totals->actual_number;
            } else {
                $num = $this->shop->max_number;
            }
        }

        if($num - $this->number >= 0) {
            Reservation::find($reservation_id)
            ->update([
                'date' => $this->date,
                'time' => $this->time,
                'number' => $this->number,
            ]);

            return redirect('/mypage')->with('result', '予約情報を更新しました');
        }else {
            return back()->withInput()->with('error', '申し訳ございません。上限人数に達しているため予約情報を変更できません');
        }
    }
}


