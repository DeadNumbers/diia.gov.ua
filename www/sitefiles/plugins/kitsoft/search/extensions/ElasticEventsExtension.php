<?php namespace KitSoft\Search\Extensions;

use KitSoft\Search\Classes\Helpers;
use KitSoft\Search\Models\Settings;


class ElasticEventsExtension
{
	/**
	 * __construct
	 */
	public function __construct()
	{
		if ((bool)Settings::get('elastic_events')) {
            $this->extendModels();
        }

	}

	/**
	 * extendModels
	 */
	protected function extendModels()
	{
		Helpers::getProvidersCollection()->each(function ($item, $key) {
            if (!Helpers::getElasticIndex($key)) {
                return;
            }

            if (!isset($item['model']) || !class_exists($item['model'])) {
                return;
            }

            $item['model']::extend(function($model) use ($item) {
            	if ($item['model'] !== get_class($model)) {
            		return;
            	}
                $model->implement[] = 'KitSoft.Search.Behaviors.ElasticModel';
            });
        });
	}
}