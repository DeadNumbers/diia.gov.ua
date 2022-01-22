<?php namespace KitSoft\Core\Extensions;

use Backend\Models\User;

class BackendUserExtension
{
	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->extendUserModel();
	}

	/**
	 * extendUserModel
	 */
	protected function extendUserModel()
	{
		User::extend(function ($model) {
			$model->rules['password'] = 'required:create|between:8,255|different_symbols:2|confirmed';
			$model->rules['password_confirmation'] = 'required_with:password|between:8,255';
		});
	}
}
