<?php

namespace Ajifatur\FaturHelper\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
        $quote = quote('random');

        // View
        return view(custom_view('admin/dashboard/index'), [
            'quote' => $quote
        ]);
    }
}