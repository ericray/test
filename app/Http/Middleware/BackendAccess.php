<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class BackendAccess
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
        $user = Auth::user();
        $hasPermission = $user->hasRole('administrador') || $user->hasRole('director');

        if(!$hasPermission){
            Auth::logout();
            \Session::flash('message_error','No tiene acceso a este panel');

            if($request->ajax()){
                return response('No autorizado',401);
            }

            return redirect()->to('/admin/login');
        }
        return $next($request);
    }
}
