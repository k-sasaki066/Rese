<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        for ($id = 1; $id <= 1000; $id++) {
            DB::table('favorites')->insert([
                'user_id' => $id,
                'shop_id' => mt_rand(1,20),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('favorites')->insert([
                'user_id' => $id,
                'shop_id' => mt_rand(1,20),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('favorites')->insert([
                'user_id' => $id,
                'shop_id' => mt_rand(1,20),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
