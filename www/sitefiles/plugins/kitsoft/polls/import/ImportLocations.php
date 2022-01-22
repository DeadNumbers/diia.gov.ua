<?php namespace KitSoft\Polls\Import;

use Exception;
use KitSoft\Polls\Models\Location;

class ImportLocations
{
	/**
	 * removeData
	 */
	public static function removeData()
	{
		Location::get()->each(function ($item) {
			$item->delete();
		});
	}

	/**
	 * importRow
	 */
	public static function importRow($item, $matches)
	{
		if (!$title = array_first($item)) {
			throw new Exeption('Location is empty.');
		}

		$slug = str_slug($title);

		if (!$object = self::find($slug)) {
			$object = Location::make();
			$object->title = $title;
			$object->slug = $slug;
			$object->save();
		}
	}

	/**
	 * find
	 */
	protected static function find($slug)
	{
		return Location::where('slug', $slug)
			->first();
	}
}