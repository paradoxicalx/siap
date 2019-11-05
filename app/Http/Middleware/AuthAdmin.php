<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
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
       if (Auth::check()) {
         $role = Auth::user()->role;

         if ($role != 'admin') {
           return redirect('home');
         }
       } else {
         return redirect('home');
       }

       return $next($request);
   }
}
