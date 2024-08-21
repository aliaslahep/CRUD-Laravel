<?php

namespace App\Http\Controllers;

use App\Models\Access_logs;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use PDF;

use App\Models\User;
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

        $filter_log = DB::table("access_logs")
                            ->leftJoin("users","access_logs.user_id","=","users.id")
                            ->whereBetween('access_log' , [$from,$to]);

        if($user != ""){
            
            $filter_log->where('user_id','=', $user);

        }

        if($url != ""){

            $filter_log->where('url','=', $url);

        }

        $filter_log = $filter_log->get();

        $log_url = DB::table("access_logs")->select("url")->distinct()->get();

        $users = DB::table("users")->get();


        return view('/access-log',[

            'logs'=> $filter_log,
            "logs_url"=> $log_url,
            "users"=> $users,
            "old_url" =>$url,
            "old_user"=> $user

        ]);
    }

    public function generate_pdf() {

        $access_log = Access_logs::get();

              
        $pdf = PDF::loadView('pdf_download', [

            'access_logs' => $access_log

        ]);
       
        return $pdf->download('itsolutionstuff.pdf');

    }
}
