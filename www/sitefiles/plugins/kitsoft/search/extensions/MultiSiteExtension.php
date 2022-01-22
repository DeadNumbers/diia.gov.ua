<?php namespace KitSoft\Search\Extensions;

use Config;
use Event;
use KitSoft\MultiSite\Classes\Helpers as MultiSiteHelpers;
use KitSoft\MultiSite\Classes\MultiSite;
use System\Classes\PluginManager;

class MultiSiteExtension
{
	/**
	 * __construct
	 */
	public function __construct()
	{
		if (!PluginManager::instance()->hasPlugin('KitSoft.MultiSite')) {
			return;
		}
		
		// add site_id to export
		Event::listen('kitsoft.search::elasticsearch.manager.filterColumns', function($model, &$params) {
			$this->extendExportFields($model, $params);
		});

		// filter elastic request query
		Event::listen('kitsoft.search::providers.elastic.requestTemplate', function($type, &$params) {
			$this->extendElasticRequestParams($type, $params);
		});

		// filter eloquent query
		Event::listen('kitsoft.search::providers.eloquent.extendQuery', function(&$query) {
			$this->extendEloquentQuery($query);
		});
	}

	/**
	 * extendExportFields
	 */
	protected function extendExportFields($model, &$params)
	{
		if (!MultiSiteHelpers::isClassExtendedWithMultiSite($model)) {
			return;
		}

		if (!$model->site) {
			return;
		}
		
		$params['site_id'] = $model->site->site_id;
	}

	/**
	 * extendElasticRequestParams
	 */
	protected function extendElasticRequestParams($type, &$params)
	{
		if (!$model = Config::get("kitsoft.search::config.providers.{$type}.model")) {
			return;
		}

		if (!MultiSiteHelpers::isClassExtendedWithMultiSite($model::make())) {
			return;
		}

		if (request()->has('site_id') && !request()->get('site_id')) {
			return;
		}

		$params['body']['params']['selected_site_id'] = request()->has('site_id')
			? (int)request()->get('site_id')
			: MultiSite::instance()->getCurrentSiteId();
	}

	/**
	 * extendEloquentQuery
	 */
	protected function extendEloquentQuery(&$query)
	{
		if (request()->has('site_id') && !request()->get('site_id')) {
			return $query->withoutGlobalScope('multisite');
		}

		if ($site_id = request()->get('site_id')) {
			return $query->withoutGlobalScope('multisite')->multisite((int)$site_id);
		}
	}
}