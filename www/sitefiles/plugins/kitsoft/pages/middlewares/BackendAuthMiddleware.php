<?php namespace KitSoft\Pages\Middlewares;

use Backend\Facades\BackendAuth;
use Closure;

class BackendAuthMiddleware
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
    	$ip = $request->ip();

    	if (!BackendAuth::check()) {
	        return response()->json(['Not authorized.'], 403);
	    }

        return $next($request);
    }
}