<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(30)->create();
        $this->call(AreasTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        // $this->call(FavoritesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
        // $this->call(RatingsTableSeeder::class);
    }
}
