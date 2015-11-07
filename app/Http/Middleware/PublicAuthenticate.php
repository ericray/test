<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class PublicAuthenticate
{
    protected $public_auth;

    public function __construct(Guard $public_auth)
    {
        $this->public_auth = $public_auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->public_auth->guest()){
            if($request->ajax()){
                response('Unauthorized',401);
            } else{
              return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
