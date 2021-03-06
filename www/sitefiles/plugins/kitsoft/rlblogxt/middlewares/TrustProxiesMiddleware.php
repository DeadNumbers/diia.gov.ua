<?php namespace KitSoft\RLBlogXT\Middlewares;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxiesMiddleware extends Middleware
{
	/**
     * The trusted proxies for this application.
     *
     * @var array
     */
	protected $proxies = '*';

	/**
     * The headers that should be used to detect proxies.
     *
     * @var string
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}