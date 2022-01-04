<?php

namespace Ajifatur\FaturHelper\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends \App\Http\Controllers\Controller
{
    /**
     * Show the dashboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the random quote
        // $quote = quote('random');

        // View
        return view('faturhelper::admin/dashboard/index', [
            // 'quote' => $quote
        ]);
    }
}