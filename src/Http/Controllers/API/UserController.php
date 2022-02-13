<?php

namespace Ajifatur\FaturHelper\Http\Controllers\API;

use Illuminate\Http\Request;
use Ajifatur\FaturHelper\Models\Role;
use Ajifatur\FaturHelper\Models\User;

class UserController extends \App\Http\Controllers\Controller
{
    const DATASET = [
        'labels' => [],
        'colors' => [],
        'data' => [],
        'total' => 0
    ];

    const COLORS = [
        '808080', // gray
        '00FF00', // green
        'FFFF00', // yellow
        'EE204D', // red
        '0000FF', // blue
    ];

    /**
     * Get user role.
     * 
     * @return \Illuminate\Http\Response
     */
    public function role()
    {
        // Set dataset
        $dataset = self::DATASET;

        // Get roles
        $roles = Role::orderBy('is_admin','desc')->orderBy('num_order','asc')->get();

        // Loop roles
        foreach($roles as $key=>$role) {
            // Count users
            $users = User::where('role_id','=',$role->id)->count();

            // Push to dataset
            array_push($dataset['labels'], $role->name);
            array_push($dataset['colors'], self::COLORS[$key + 1]);
            array_push($dataset['data'], $users);
        }

        // Sum data
        $dataset['total'] = array_sum($dataset['data']);

        // Response
        return response()->json([
            'message' => 'Success.',
            'data' => $dataset
        ], 200);
    }

    /**
     * Get user status.
     * 
     * @return \Illuminate\Http\Response
     */
    public function status()
    {
        // Set dataset
        $dataset = self::DATASET;

        // Loop statuses
        foreach(status() as $key=>$status) {
            // Count users
            $users = User::where('status','=',$status['key'])->count();

            // Push to dataset
            array_push($dataset['labels'], $status['name']);
            array_push($dataset['colors'], self::COLORS[$key + 1]);
            array_push($dataset['data'], $users);
        }

        // Sum data
        $dataset['total'] = array_sum($dataset['data']);

        // Response
        return response()->json([
            'message' => 'Success.',
            'data' => $dataset
        ], 200);
    }
}
