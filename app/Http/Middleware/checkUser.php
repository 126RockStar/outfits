<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkUser
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
        if(Auth::check()){
            if(Auth::user()->type=='user'){
                return $next($request);
            }else{
                return redirect(url('/'))->with('error','invalid access');
            }
        }else{
            return redirect(url('/'))->with('error','invalid access');
        }
    }
}
