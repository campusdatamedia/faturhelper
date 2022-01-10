<?php

namespace Ajifatur\FaturHelper\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\FaturHelper\Models\Setting;

class SettingController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // // Get metas
        // $metas = ['description', 'keywords', 'author'];

        // // View
        // return view('faturhelper::admin/meta/index', [
        //     'metas' => $metas
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Update via AJAX
        if($request->isAjax == true) {
            // Update the setting
            $setting = Setting::where('code','=',$request->code)->first();
            $setting->content = $request->content;
            $setting->save();

            // Response
            return response()->json("Success!");
        }
    }
}
