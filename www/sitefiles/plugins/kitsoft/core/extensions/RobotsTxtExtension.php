<?php namespace KitSoft\Core\Extensions;

use Backend\Widgets\ReportContainer;

class RobotsTxtExtension
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
            $widget->config->defaultWidgets['robotsTxt'] = [
                'class' => 'KitSoft\Core\ReportWidgets\RobotsTxt',
                'sortOrder' => 9,
                'configuration' => [
                    'ocWidgetWidth' => 5
                ]
            ];
        });
	}
}