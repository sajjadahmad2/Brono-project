<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::create(['name' => 'add role']);
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'manage permissions']);

        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'manage settings']);

        
    }
}
