<?php

namespace Ajifatur\FaturHelper\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogController extends \App\Http\Controllers\Controller
{
    /**
     * Convert log to array.
     * 
     * @param  string  $type
     * @param  string  $file
     * @return array
     */
    public function logToArray($type, $file)
    {
        $logs = [];

        if(File::exists($file)) {
            // Get log
            $contents = preg_split('/\r\n|\r|\n/', file_get_contents($file));
            $contents = is_array($contents) ? array_filter($contents) : [];

            // Get log info
            if(count($contents) > 0) {
                foreach($contents as $content) {
                    $info = explode('.'.strtoupper($type).': ', trim($content));
                    if(count($info) == 2) {
                        $log = json_decode($info[1], true); // JSON to Array
                        $log['datetime'] = substr($info[0],1,19); // Datetime
                        $log['environment'] = substr($info[0],22); // Environment
                        array_push($logs, $log); // Push
                    }
                }
            }
        }

        return $logs;
    }

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

        // Get month and year
        $month = $request->query('month') ?: date('n');
        $year = $request->query('year') ?: date('Y');

        // Set month to date('m') format
        $monthString = strlen($month) == 2 ? $month : '0'.$month;

        if($request->ajax()) {
            // Return datatables
            return datatables()->of($this->logToArray('info', storage_path('logs/activities-'.$year.'-'.$monthString.'.log')))
                ->addColumn('user', '
                    @php $user = \Ajifatur\FaturHelper\Models\User::find($user_id); @endphp
                    @if($user)
                        <a href="{{ \Route::has(\'admin.user.detail\') ? route(\'admin.user.detail\', [\'id\' => $user->id]) : \'#\' }}" target="_blank">{{ $user->name }}</a>
                        <br>
                        <small>{{ $user->role ? $user->role->name : "" }}</small>
                    @endif
                ')
                ->editColumn('datetime', '
                    <span class="d-none">{{ $datetime }}</span>
                    {{ date("d/m/Y", strtotime($datetime)) }}
                    <br>
                    <small>{{ date("H:i:s", strtotime($datetime)) }}</small>
                ')
                ->editColumn('url', '
                    @if($method == "GET" && (isset($ajax) && $ajax == false))
                        <a class="url-text" href="{{ $url }}" target="_blank" style="word-break: break-all;">
                            {{ $url }}
                        </a>
                    @elseif($method == "GET" && !isset($ajax))
                        <a href="{{ $url }}" target="_blank" style="word-break: break-all;">
                            {{ $url }}
                        </a>
                    @else
                        <span class="url-text" style="word-break: break-all;">
                            @if(strlen($url) > 100)
                                {{ substr($url,0,100) }}
                                <a href="#" class="btn-read-more text-success">Read More</a>
                                <span class="more-text d-none">{{ substr($url,100) }} <br> <a href="#" class="btn-read-less text-success">Read Less</a></span>
                            @else
                                {{ $url }}
                            @endif
                        </span>
                    @endif
                ')
                ->editColumn('method', '
                    @if(isset($ajax) && $ajax == true)
                        {{ $method }} (AJAX)
                    @else
                        {{ $method }}
                    @endif
                ')
                ->rawColumns(['user', 'datetime', 'url', 'method'])
                ->make(true);
        }

        // View
        return view('faturhelper::admin/log/activity', [
            'month' => $month,
            'year' => $year,
        ]);
    }

    /**
     * Display the authentication log.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authentication(Request $request)
    {
        // Check the access
        has_access(method(__METHOD__), Auth::user()->role_id);

        if($request->ajax()) {
            // Return datatables
            return datatables()->of($this->logToArray('error', storage_path('logs/authentications.log')))
                ->editColumn('datetime', '
                    <span class="d-none">{{ $datetime }}</span>
                    {{ date("d/m/Y", strtotime($datetime)) }}
                    <br>
                    <small>{{ date("H:i:s", strtotime($datetime)) }}</small>
                ')
                ->rawColumns(['datetime'])
                ->make(true);
        }

        // View
        return view('faturhelper::admin/log/authentication');
    }
}
