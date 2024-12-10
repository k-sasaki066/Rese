<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use Carbon\Carbon;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reservations = Reservation::where('user_id', '<=', 10)->get();
        $now = Carbon::now()->format('Y-m-d H:i:s');
        foreach($reservations as $reservation) {
            DB::table('ratings')->insert([
                'user_id' => $reservation['user_id'],
                'shop_id' => $reservation['shop_id'],
                'reservation_id' => $reservation['id'],
                'rating' => mt_rand(3,5),
                'comment' => 'とても美味しかったです！',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
