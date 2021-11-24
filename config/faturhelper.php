<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    */

    'models' => [
        'permission' => \Ajifatur\FaturHelper\Models\Permission::class,
        'role' => \Ajifatur\FaturHelper\Models\Role::class,
        'user' => \Ajifatur\Campusnet\Models\User::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Package
    |--------------------------------------------------------------------------
    |
    */

    'package' => [
        'view' => ''
    ],
    
];