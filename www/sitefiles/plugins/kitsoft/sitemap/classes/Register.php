<?php namespace KitSoft\Sitemap\Classes;

use Illuminate\Config\Repository;
use Laravelium\Sitemap\Sitemap;
use October\Rain\Foundation\Application;

/**
 * Register
 */
class Register
{
	/**
	 * run
	 */
	public static function run(Application $app)
	{
		$app->bind('sitemap-builder', function ($app) {
            $config = config('sitemap');

            return new Sitemap(
                $config,
                $app['Illuminate\Cache\Repository'],
                new Repository,
                $app['files'],
                $app['Illuminate\Contracts\Routing\ResponseFactory'],
                $app['view']
            );
        });

        $app->alias('sitemap-builder', Sitemap::class);
	}
}
