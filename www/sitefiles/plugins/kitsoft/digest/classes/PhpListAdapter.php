<?php namespace KitSoft\Digest\Classes;

use ApplicationException;
use Exception;
use KitSoft\Digest\Lib\phpListRESTApiClient;
use KitSoft\Digest\Models\Settings;

class PhpListAdapter
{
	use \October\Rain\Support\Traits\Singleton;

	public $client;

	/**
	 * init
	 */
	public function init()
	{
		$this->client = new phpListRESTApiClient(
			Settings::get('phplist.apiUrl'),
			Settings::get('phplist.login'),
			Settings::get('phplist.password'),
			Settings::get('phplist.secret')
		);

		$this->client->tmpPath = storage_path('temp');

		try {
			$this->client->login();
		} catch (Exception $e) {
			throw new ApplicationException('Php List api connection failed.');
		}
	}

	/**
	 * getListsCollection
	 */
	public function getListsCollection()
	{
		return collect($this->client->listsGet());
	}

	/**
	 * campaignsGet
	 */
	public function getCampaignsCollection()
	{
		return collect($this->client->campaignsGet());
	}

	/**
	 * __call
	 */
	public function __call($method, $params)
	{
		return $this->client->{$method}(...$params);
	}
}