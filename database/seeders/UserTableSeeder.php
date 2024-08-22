<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::where('email', 'superadmin@gmail.com')->first();
        if (!$admin) {
            $admin = User::create([
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('12345678'),
            ]);
        }

        $adminRole = Role::where('name', 'admin')->first();
        if (Role::count() == 0) {
            $adminRole = Role::create([
                'guard_name' => 'web',
                'name' => 'admin',
            ]);
        }

        $admin->assignRole($adminRole);
    }
}
