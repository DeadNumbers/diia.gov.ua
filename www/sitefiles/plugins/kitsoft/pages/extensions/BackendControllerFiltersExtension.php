<?php namespace KitSoft\Pages\Extensions;

use Backend\Classes\Controller;

class BackendControllerFiltersExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
    	Controller::extend(function ($controller) {
	        if ($this->isFilterRequest()) {
    			$this->fixDaterangeEmptyMinValue();
    		}
    	});
    }

    /**
     * isFilterRequest
     */
    protected function isFilterRequest()
    {
    	if (!request()->ajax()) {
    		return false;
    	}

    	return request()->header('x-october-request-handler') == 'listFilter::onFilterUpdate';
    }

    /**
     * fixDaterangeEmptyMinValue
     * fix daterange backend filter, default value is 0000-00-00 00:00:00, after Carbon parse = -0001-00-00 00:00:00 and postgres query crash with error, change it to 1800-00-01 00:00:00
     */
    protected function fixDaterangeEmptyMinValue()
    {
        if (!$dates = post('options.dates')) {
        	return;
        }

        if (!isset($dates[0])) {
        	return;
        }

        if (!empty($dates[0])) {
        	return;
        }

        $options = post('options');

        $options['dates'][0] = '1800-01-01 00:00:00';

        request()->merge(['options' => $options]);       
    }
}
