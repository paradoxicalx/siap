<?php

namespace App\Http\Middleware;

use Closure;
use App;

class Localization
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
      if (\Session::has('locale')) {
           \App::setlocale(\Session::get('locale'));
       } else if ($request->hasHeader('X-localization')) {
         $local = ($request->hasHeader('X-localization')) ? $request->header('X-localization') : 'en';
         \App::setlocale($local);
       }
       return $next($request);
    }
}
