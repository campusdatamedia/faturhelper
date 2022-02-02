<?php

namespace Ajifatur\FaturHelper\Seeders;

use Illuminate\Database\Seeder;
use Ajifatur\FaturHelper\Models\Meta;

class MetaSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $metas = [
            ['code' => 'description', 'content' => ''],
            ['code' => 'keywords', 'content' => ''],
            ['code' => 'author', 'content' => ''],
        ];

        foreach($metas as $meta) {
            Meta::firstOrCreate(
                ['code' => $meta['code']],
                ['content' => $meta['content']]
            );
        }
    }
}
