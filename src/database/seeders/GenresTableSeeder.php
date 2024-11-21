<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            "和食",
            "寿司",
            "焼肉",
            "鍋",
            "中華",
            "ラーメン",
            "カレー",
            "イタリアン",
            "フレンチ",
            "居酒屋",
            "カフェ",
            "スイーツ",
            "その他",
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre,
            ]);
        }
    }
}
