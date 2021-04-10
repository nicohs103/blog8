<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create(['name' => 'admin', 'email' => 'admin@admin.com', 'password' => bcrypt('admin')]);
        $role = Role::find(2);
        $admin->roles()->save($role);
    }
}
