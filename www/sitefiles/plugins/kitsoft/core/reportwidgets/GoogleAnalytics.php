<?php namespace KitSoft\Core\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Kitsoft\Core\Models\GoogleAnalytics as GoogleAnalyticsSettings;

class GoogleAnalytics extends ReportWidgetBase
{

    public function render()
    {
    	$this->prepareVars();

        return $this->makePartial('widget');
    }

    /**
     * prepareVars
     */
    protected function prepareVars()
    {
        $settings = GoogleAnalyticsSettings::instance();
        $this->vars['type'] = $settings->type;
        $this->vars['enabled'] = (boolean)$settings->enabledCode;
    }
}
