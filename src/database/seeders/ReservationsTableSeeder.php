<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use DateTimeImmutable;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start = Carbon::now()->subDay(7)->format('Y-m-d');
        $end = Carbon::now()->addDay(14)->format('Y-m-d');

        for ($id = 1; $id <= 20; $id++) {
            for ($i = new DateTime($start); $i <= new DateTimeImmutable($end); $i->modify('+1 day')) {
                for ($t = 12; $t <= 19; $t++)
                    DB::table('reservations')->insert([
                        'user_id' => mt_rand(1,1000),
                        'shop_id' => $id,
                        'date' => $i->format('Y-m-d'),
                        'time' => $t.':00',
                        'number' => mt_rand(1,5),
                        'menu_id' => mt_rand(1,9),
                        'payment' => mt_rand(1,2),
                        'status' => 1,
                        'created_at' => $i->format('Y-m-d 08:00:00'),
                        'updated_at' => $i->format('Y-m-d 17:30:00'),
                    ]);
            }
        }
    }
}
