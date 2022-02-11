<?php

namespace Ajifatur\FaturHelper\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LogController extends \App\Http\Controllers\Controller
{
    /**
     * Display the activity log.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activity(Request $request)
    {
        // Check the access
        has_access(method(__METHOD__), Auth::user()->role_id);

        // Array log
        $logs = [];

        // Get log
        $contents = preg_split('/\r\n|\r|\n/', file_get_contents(storage_path('logs/activities.log')));
        $contents = is_array($contents) ? array_filter($contents) : [];

        // Get log info
        if(count($contents) > 0) {
            foreach($contents as $content) {
                $info = explode(' local.INFO: ', trim($content));
                if(count($info) == 2) {
                    $info[0] = str_replace('[','',$info[0]);
                    $info[0] = str_replace(']','',$info[0]);
                    $info[1] = json_decode($info[1], true);
                }
                array_push($logs, $info);
            }
        }
        rsort($logs);

        // View
        return view('faturhelper::admin/log/activity', [
            'logs' => $logs
        ]);
    }
}
