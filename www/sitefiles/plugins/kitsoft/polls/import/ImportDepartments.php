<?php namespace KitSoft\Polls\Import;

use Exception;
use KitSoft\Polls\Models\Department;

class ImportDepartments
{
	/**
	 * removeData
	 */
	public static function removeData()
	{
		Department::get()->each(function ($item) {
			$item->delete();
		});
	}

	/**
	 * importRow
	 */
	public static function importRow($item, $matches)
	{
		if (!$title = array_first($item)) {
			throw new Exeption('Department title column is empty.');
		}

		$slug = str_slug($title);

		if (!$object = self::find($slug)) {
			$object = Department::make();
			$object->title = $title;
			$object->text = self::getText($item, $matches);
			$object->slug = $slug;
			$object->save();
		}
	}

	/**
	 * find
	 */
	protected static function find($slug)
	{
		return Department::where('slug', $slug)
			->first();
	}

	/**
	 * getText
	 */
	protected static function getText($item, $matches)
	{
		$text = '';

		for ($i = 1; $i <= 5; $i++) {
			$text .= '<p>' . $matches[$i] . '<br>' . $item[$i] . '</p>';
		}

		return $text;
	}
}