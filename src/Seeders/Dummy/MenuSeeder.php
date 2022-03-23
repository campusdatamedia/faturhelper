<?php

namespace Ajifatur\FaturHelper\Seeders\Dummy;

use Illuminate\Database\Seeder;
use Ajifatur\FaturHelper\Models\MenuHeader;
use Ajifatur\FaturHelper\Models\MenuItem;

class MenuSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            ['name' => '', 'num_order' => 1, 'children' => [
                ['name' => 'Dashboard', 'route' => 'admin.dashboard', 'routeparams' => '', 'icon' => 'bi-speedometer2', 'visible_conditions' => '', 'active_conditions' => "Request::url() == route('admin.dashboard')", 'parent' => 0, 'num_order' => 1]
            ]]
        ];

        foreach($menus as $menu) {
            $menu_header = MenuHeader::firstOrCreate(
                ['name' => $menu['name']],
                ['num_order' => $menu['num_order']]
            );
            
            if(count($menu['children']) > 0) {
                foreach($menu['children'] as $child) {
                    $menu_item = MenuItem::firstOrCreate(
                        ['menuheader_id' => $menu_header->id,'name' => $child['name']],
                        ['route' => $child['route'], 'routeparams' => $child['routeparams'], 'icon' => $child['icon'], 'visible_conditions' => $child['visible_conditions'], 'active_conditions' => $child['active_conditions'], 'parent' => $child['parent'], 'num_order' => $child['num_order']]
                    );
                }
            }
        }
    }
}
