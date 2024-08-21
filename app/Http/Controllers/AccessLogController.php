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

        if ($request->has('download') && $request->download == 'pdf') {
            return $this->generate_pdf($filter_log);
        }


        return view('/access-log',[

            'logs'=> $filter_log,
            "logs_url"=> $log_url,
            "users"=> $users,
            "old_url" =>$url,
            "old_user"=> $user,
            "old_from" => $from,
            "old_to" => $to

        ]);
    }

    public function generate_pdf($from ,$to,$user_id) {

        $filter_log = DB::table('access_logs')
                        ->leftJoin('users','access_logs.user_id','=','users.id')
                        ->whereBetween('access_log',[$from,$to])
                        ->where('user_id','=',$user_id)
                        ->get();
              
        $pdf = PDF::loadView('pdf_download', [

            'access_logs' => $filter_log

        ]);
       
        return $pdf->download('access-log.pdf');

    }
}
