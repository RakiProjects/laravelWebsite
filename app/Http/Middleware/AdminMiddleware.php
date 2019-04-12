<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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

         if (session()->has('user')) {
            if (session()->get('user')->role_id == 1) {
                return $next($request);
            }else{
                \Log::warning("[".date('Y-m-d H:i:s')."] korisnik ".session()->get('user')->username." je pokusao da pristupi admin panelu bez dozvole!!!");
            }
        }else{
            \Log::warning("[".date('Y-m-d H:i:s')."] korisnik sa IP ".$request->ip()." je pokusao da pristupi admin panelu bez dozvole!!!");
        }
        return redirect(route("home"));
    }
}
