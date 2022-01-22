<?php namespace KitSoft\RLBlogXT\Middlewares;

use Closure;
use Request;
use KitSoft\RLBlogXT\Models\Settings;

class AllowedIpsMiddleware
{
	protected $allowed_ips;

	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->allowed_ips = $this->getAllowedIps();
	}

	/**
	 * getAllowedIps
	 */
	public function getAllowedIps()
	{
		if (!$allowed_ips = Settings::get('api_allowed_ips')) {
			return [];
		}

		return array_pluck($allowed_ips, 'ip');
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
    	$ip = $request->ip();

    	if (!in_array($ip, $this->allowed_ips)) {
	        return response()->json(["IP address [{$ip}] rejected"], 403);
	    }

        return $next($request);
    }
}