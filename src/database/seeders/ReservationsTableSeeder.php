<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reservations = [
            [
                'user_id'=>'1',
                'shop_id'=>'1',
                'date'=>'2024-11-29',
                'time'=>'15:00:00',
                'number'=>'2',
            ],
            [
                'user_id'=>'1',
                'shop_id'=>'1',
                'date'=>'2024-11-30',
                'time'=>'19:00:00',
                'number'=>'4',
            ],
            [
                'user_id'=>'1',
                'shop_id'=>'1',
                'date'=>'2024-12-01',
                'time'=>'18:00:00',
                'number'=>'3',
            ],
            [
                'user_id'=>'2',
                'shop_id'=>'1',
                'date'=>'2024-11-30',
                'time'=>'18:00:00',
                'number'=>'3',
            ],
            [
                'user_id'=>'2',
                'shop_id'=>'1',
                'date'=>'2024-12-01',
                'time'=>'18:00:00',
                'number'=>'4',
            ],
            [
                'user_id'=>'3',
                'shop_id'=>'1',
                'date'=>'2024-12-02',
                'time'=>'18:00:00',
                'number'=>'2',
            ],
        ];

        foreach ($reservations as $reservation) {
            DB::table('reservations')->insert($reservation);
        }
    }
}
