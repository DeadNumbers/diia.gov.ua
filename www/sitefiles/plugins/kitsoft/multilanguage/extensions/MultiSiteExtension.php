<?php namespace KitSoft\Multilanguage\Extensions;

use Event;
use October\Rain\Database\Collection;

class MultiSiteExtension
{
    /*
     * Construct
     */
	public function __construct() {
        $this->translateSiteModelFields();
	}

	/**
	 * translateSiteModelFields
	 */
	protected function translateSiteModelFields()
	{
		Event::listen('kitsoft.multisite::sites.collection', function (Collection &$sites) {
			$sites->each(function ($site) {
                $site->translateFields();
            });

            $sites = $sites->sortBy('name');
		});
	}
}
