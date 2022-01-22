<?php namespace KitSoft\Diia\Middlewares;

use Config;
use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
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
        if (!$origin = $request->headers->get('Origin')) {
            return $next($request);
        }

        if ($origin == $request->getSchemeAndHttpHost()) {
            return $next($request);
        }

        $this->setHeaders($origin);
        
        return $next($request);
    }

    /**
     * setHeaders
     */
    protected function setHeaders(string $origin): void
    {
        $allowOrigins = Config::get('kitsoft.diia::cors.allow_origins');

        if (in_array('*', $allowOrigins)) {
            header('Access-Control-Allow-Origin: *');
        }

        if (in_array($origin, Config::get('kitsoft.diia::cors.allow_origins'))) {
            header('Access-Control-Allow-Origin: ' . $origin);
        }
    }
}