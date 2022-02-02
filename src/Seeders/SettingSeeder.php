<?php

namespace Ajifatur\FaturHelper\Seeders;

use Illuminate\Database\Seeder;
use Ajifatur\FaturHelper\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['code' => 'theme', 'content' => 'default'],
        ];

        foreach($settings as $setting) {
            Setting::firstOrCreate(
                ['code' => $setting['code']],
                ['content' => $setting['content']]
            );
        }
    }
}
