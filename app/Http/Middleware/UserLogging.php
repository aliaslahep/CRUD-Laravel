<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserLogging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::check()) {

            $user = Auth::user();

            $url = $request->url();

            $ip_address = $request->ip(); 

            DB::table("access_logs")->insert([

                "ip_address" => $ip_address,

                "user_id"=> $user->id,

                "url"=> $url,

                "access_log"=> now()

           ]);
        
        }

        return $next($request);
    }
}
