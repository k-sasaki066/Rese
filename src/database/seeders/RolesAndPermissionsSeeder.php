<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

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

        $admin = User::create([
        'name' => '管理太郎',
        'email' => 'kanri_taro@test.com',
        'password' => bcrypt('test1234'),
        ]);
        $admin->assignRole('admin');

        $editor = User::create([
        'name' => '店舗花子',
        'email' => 'tenpo_hanako@test.com',
        'password' => bcrypt('test1234'),
        ]);
        $editor->assignRole('editor');
    }
}
