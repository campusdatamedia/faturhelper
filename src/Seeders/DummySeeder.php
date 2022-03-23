<?php

namespace Ajifatur\FaturHelper\Seeders;

use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Ajifatur\FaturHelper\Seeders\Dummy\RoleSeeder::class);
        $this->call(\Ajifatur\FaturHelper\Seeders\Dummy\UserSeeder::class);
        $this->call(\Ajifatur\FaturHelper\Seeders\Dummy\MenuSeeder::class);
    }
}
