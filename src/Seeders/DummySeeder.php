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
        $this->call(DummyUserSeeder::class);
    }
}
