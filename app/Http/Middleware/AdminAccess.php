<?php

namespace App\Http\Middleware;

use Closure;

class AdminAccess
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
        $user = \Auth::user();
        $acceso = $user->can('ingreso_admin');

        if(!$acceso){
            return response(view('errors.403'),403);
        }

        return $next($request);
    }
}
