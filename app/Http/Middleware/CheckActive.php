<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::currentRouteName();
        // dd(in_array($routeName,['userticket.index',"userticket.create"]) && !$request->user()->active);
        if(!in_array($routeName,['userticket.index',"userticket.create"]) && $request->user()->role!="admin"){
            if(!$request->user()->active){
                alert()->warning("حساب شما تااطلاع ثانویه مسدود شده است با پشتیبانی در ارتباط باشید ");
                return redirect()->route("userticket.index");
            }else{

            }
         }else{

        }

    //    if(!$request->user()->active){
    //     dd( $routeName);
    //     // return redirect()->route("userticket.index");

    //    }
        return $next($request);
    }
}
