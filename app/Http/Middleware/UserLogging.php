<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Modules\Access_Logs\Models\Access_Logs;


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

            $access_logs = new Access_logs();

            $access_logs->ip_address = $ip_address;

            $access_logs->user_id = $user->id;

            $access_logs->url = $url;

            $access_logs->access_log = now();
            
            $access_logs->access_log = now();

            $access_logs->save();
        
        }

        return $next($request);
    }
}
