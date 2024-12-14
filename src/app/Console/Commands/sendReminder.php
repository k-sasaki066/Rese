<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Reservation;
use App\Notifications\ReservationReminder;

class sendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendReminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to send reminder-mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');
        $reservations = Reservation::with('user')->where('date', $today)->get();
        
        foreach($reservations as $reservation) {
            ($reservation->user)->notify(new ReservationReminder ($reservation));
        }
    }
}
