<?php namespace KitSoft\Core\Extensions;

use Backend\Widgets\ReportContainer;

class GoogleAnalyticsExtension
{
	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->addDefaultReportWidget();
	}

	/**
	 * addDefaultReportWidget
	 */
	protected function addDefaultReportWidget()
	{
		ReportContainer::extend(function ($widget) {
            $widget->config->defaultWidgets['googleAnalytics'] = [
                'class' => 'KitSoft\Core\ReportWidgets\GoogleAnalytics',
                'sortOrder' => 10,
                'configuration' => [
                    'ocWidgetWidth' => 5
                ]
            ];
        });
	}
}