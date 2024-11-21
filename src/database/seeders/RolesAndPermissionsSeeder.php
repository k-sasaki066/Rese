<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masterPermission = Permission::create(['name' => 'master']);
        $writerPermission = Permission::create(['name' => 'writer']);

        Role::create(['name' => 'admin'])
            ->givePermissionTo($masterPermission);
        Role::create(['name' => 'editor'])
            ->givePermissionTo($writerPermission);
    }
}
