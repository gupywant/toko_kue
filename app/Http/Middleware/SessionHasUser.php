<?php

namespace App\Http\Middleware;

use Closure;

class SessionHasUser
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
        if($request->session()->exists('user')) {
            return $next($request);
        }else{
            if(session('alert')){
                return redirect('login/user')->with('alert','Username atau Password salah!!!');
            }else{
                return redirect('login/user')->with('alert','Login Terlebih Dahulu');
            }
        }
    }
}
