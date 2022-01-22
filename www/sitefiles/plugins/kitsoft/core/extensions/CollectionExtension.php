<?php namespace KitSoft\Core\Extensions;

use App;
use Illuminate\Support\Collection;

class CollectionExtension
{
	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->addMethods();
	}

	/**
	 * addMethods
	 */
	protected function addMethods()
	{
		Collection::macro('sortByCollator', function (string $field, $descending = false) {
			$results = [];
			
			foreach ($this->items as $key => $value) {
            	$results[$key] = data_get($value, $field);
	        }

	        $locale = App::getLocale();

	        collator_asort(collator_create($locale), $results);

	        foreach (array_keys($results) as $key) {
	            $results[$key] = $this->items[$key];
	        }

	        if ($descending) {
	        	$results = array_reverse($results);
	        }

	        return new static($results);
		});
	}
}
