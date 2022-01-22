<?php namespace KitSoft\Core\Extensions;

use Log;
use Event;
use Exception;
use Raven_Client;
use KitSoft\Core\Models\Sentry;
use Monolog\Handler\RavenHandler;

class SentryExtension
{
	protected $settings;

	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->settings = Sentry::instance();

		if ($this->settings->isEnabled) {
			$this->setPhpSentryHandler();
			$this->setJsSentryHandler();
		}
	}

	/**
	 * setPhpSentryHandler
	 */
	protected function setPhpSentryHandler()
	{
        try {
		    $dsn = $this->settings->get('dsn');
		    $level = $this->settings->get('error_level');

		    $config = [
		        'environment' => env('APP_ENV', 'undefined'),
		        'timeout' => 2,
		        'release' => env('RELEASE', 'undefined')
		    ];

		    $client = new Raven_Client($dsn, $config);
		    $handler = new RavenHandler($client, $level);

		    $monolog = Log::getMonolog();
		    $monolog->pushHandler($handler);
		} catch (Exception $e) {
			trace_log($e);
		}
	}

	/**
	 * setJsSentryHandler
	 */
	protected function setJsSentryHandler()
	{
		Event::listen('cms.page.beforeDisplay', function ($controller) {
			$controller->addJs('https://cdn.ravenjs.com/3.26.4/raven.min.js');
		});
	}
}