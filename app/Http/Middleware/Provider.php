<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Closure;

class Provider
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_role = DB::table('user_roles')->select('user_role_type_id')->where('user_id','=',Auth::user()->id)->first();
        if($user_role->user_role_type_id == 2)
        {
            return $next($request);
        }
        elseif($user_role->user_role_type_id == 1)
        {
            return redirect()->route('adminhome');
        }
        else
        {
            return redirect()->route('plans');
        }
    }
}
