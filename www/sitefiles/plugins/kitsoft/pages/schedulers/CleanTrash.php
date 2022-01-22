<?php namespace KitSoft\Pages\Schedulers;

use Illuminate\Support\Carbon;
use KitSoft\Pages\Models\Page;

class CleanTrash
{
	/**
	 * __construct
	 */
	public function __construct() {
		$period = Carbon::parse('-75 days');

		Page::withoutGlobalScopes()
			->onlyTrashed()
			->whereDate('deleted_at', '<=', $period)
			->get()
			->each(function ($item) {
				$item->forceDelete();
			});
	}
}