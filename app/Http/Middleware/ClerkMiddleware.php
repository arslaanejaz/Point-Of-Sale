<?php

namespace App\Http\Middleware;

use Closure;

class ClerkMiddleware
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
    	$user = $request->user();
    	if(!$user){
    		return redirect()->guest('auth/login');
    	}elseif($user->role>1){
    		return response('Unauthorized.', 401);
    	}
        return $next($request);
    }
}
