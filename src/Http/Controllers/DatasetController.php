<?php

namespace Ajifatur\FaturHelper\Http\Controllers;

use Auth;
use File;
use Illuminate\Http\Request;

class DatasetController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // View
        if(File::exists(base_path('vendor/ajifatur/faturhelper/resources/views/admin/dataset/'.$request->query('json').'.blade.php')))
            return view('faturhelper::admin/dataset/'.$request->query('json'));
        else
            return view('faturhelper::admin/dataset/index');
    }
}
