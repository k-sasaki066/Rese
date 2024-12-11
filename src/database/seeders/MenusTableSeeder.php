<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Shop;
use Carbon\Carbon;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($id = 1; $id <= 20; $id++) {
            $now = Carbon::now()->format('Y-m-d H:i:s');
            $shop_name = Shop::find($id)->name;

            DB::table('menus')->insert([
                'shop_id' => $id,
                'name' => $shop_name.'-Aコース',
                'price' => '4000',
                'detail' => '季節ごとに異なる食材を選び、最大限に生かす調理法で、旬の味わいを引き出します。一品一品が美しく装飾され、味覚だけでなく、視覚や嗅覚も楽しめるコースです。',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('menus')->insert([
                'shop_id' => $id,
                'name' => $shop_name.'-Bコース',
                'price' => '3000',
                'detail' => '季節ごとに異なる食材を選び、最大限に生かす調理法で、旬の味わいを引き出します。品数を厳選し、限られた中で存分に味わっていただけるよう工夫して提供しております。',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('menus')->insert([
                'shop_id' => $id,
                'name' => $shop_name.'-Cコース',
                'price' => '2000',
                'detail' => '季節ごとに異なる食材を選び、最大限に生かす調理法で、旬の味わいを引き出します。品数を厳選し、多くの方に楽しんでいただけるようお値段もリーズナブルに設定しております。',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
