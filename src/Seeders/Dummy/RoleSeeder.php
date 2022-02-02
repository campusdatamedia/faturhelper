<?php

namespace Ajifatur\FaturHelper\Seeders\Dummy;

use Illuminate\Database\Seeder;
use Ajifatur\FaturHelper\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['code' => 'super-admin', 'name' => 'Super Admin', 'is_admin' => 1, 'num_order' => 1]
        ];

        foreach($roles as $role) {
            Role::firstOrCreate(
                ['code' => $role['code']],
                ['name' => $role['name'], 'is_admin' => $role['is_admin'], 'num_order' => $role['num_order']]
            );
        }
    }
}
