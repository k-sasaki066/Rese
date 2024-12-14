<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $start = '2024-12-13';
        $end = '2024-12-14';

        for ($id = 1; $id <= 20; $id++) {
            for ($i = new DateTime($start); $i <= new DateTimeImmutable($end); $i->modify('+1 day')) {
                for ($t = 13; $t <= 17; $t++)
                    DB::table('reservations')->insert([
                        'user_id' => mt_rand(1,30),
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
