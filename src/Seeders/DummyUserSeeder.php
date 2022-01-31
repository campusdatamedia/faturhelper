<?php

namespace Ajifatur\FaturHelper\Seeders;

use Illuminate\Database\Seeder;
use Ajifatur\FaturHelper\Models\User;
use Ajifatur\FaturHelper\Models\Role;

class DummyUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Get the super admin role
        $role = Role::where('code','=','super-admin')->first();

        if($role) {
            // Add the super admin
            $super_admin = User::where('role_id','=',$role->id)->count();
            if($super_admin <= 0) {
                $user = new User;
                $user->role_id = $role->id;
                $user->name = 'Admin';
                $user->username = 'admin@admin.com';
                $user->email = 'admin@admin.com';
                $user->password = bcrypt('password');
                $user->status = 1;
            }
        }
    }
}
