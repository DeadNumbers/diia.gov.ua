<?php namespace KitSoft\Search\Controllers;

use Exception;
use KitSoft\Search\Classes\Helpers;

/**
 * Search
 */
class Search
{
	/**
	 * getTypes
	 */
	public function getTypes()
	{
		try {
			$types = Helpers::getProvidersCollection()
				->mapWithKeys(function ($item, $key) {
					return [$key => [
						'hidden' => $item['hidden'] ?? false
					]];
				});
		} catch (Exception $e) {
			trace_log($e);
			
			return response()->json([
                'error' => $e->getMessage()
            ], 500);
		}

		return response()->json($types);
	}
}