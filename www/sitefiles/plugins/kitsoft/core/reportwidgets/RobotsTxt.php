<?php namespace KitSoft\Core\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Kitsoft\Core\Models\RobotsTxt as Settings;

class RobotsTxt extends ReportWidgetBase
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
    	$this->vars['enabled'] = $this->isEnabled();
    }

    /**
     * isEnabled
     */
    protected function isEnabled()
    {
    	if (!Settings::get('status')) {
    		return false;
    	}

    	if (!$code = Settings::get('code')) {
    		return false;
    	}

    	if (preg_match_all('/Disallow:(.*)/i', $code, $matches)) {
    		foreach ($matches[1] as $url) {
    			if (trim($url) == '/') {
    				return false;
    			}
    		}
   		}

    	return true;
    }
}