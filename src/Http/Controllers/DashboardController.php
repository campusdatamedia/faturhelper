<?php

namespace Ajifatur\FaturHelper\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends \App\Http\Controllers\Controller
{
    /**
     * Show the dashboard page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // View
        return view('admin/dashboard/index');
    }
}