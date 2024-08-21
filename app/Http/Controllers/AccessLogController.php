<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AccessLogController extends Controller
{
    public function access_log() {

        $log = DB::table("access_logs")->leftJoin("users","access_logs.user_id","=","users.id")->get();

        $log_url = DB::table("access_logs")->select("url")->distinct()->get();

        $users = DB::table("users")->get();

        return view("access-log",[

            "logs"=> $log,
            "logs_url"=> $log_url,
            "users"=> $users
        ]);
    }

    public function filter_log(Request $request) {

        $user = $request->user;

        $url = $request->url;

        $from = date('Y-m-d H:i:s',strtotime($request->from));

        $to = $request->to;

        if($to == "") {
            $to = now();
        } else {

            $to = date('Y-m-d 23:59:59',strtotime($request->to));
        }

        $filter_log = DB::table("access_logs")->leftJoin("users","access_logs.user_id","=","users.id")->whereBetween('access_log' , [$from,$to])->get();

        $log_url = DB::table("access_logs")->select("url")->distinct()->get();

        $users = DB::table("users")->get();


        return view('/access-log',[

            'logs'=> $filter_log,
            "logs_url"=> $log_url,
            "users"=> $users,
            "to"=> date('Y-m-d',strtotime("$to"))
        ]);
    }
}
