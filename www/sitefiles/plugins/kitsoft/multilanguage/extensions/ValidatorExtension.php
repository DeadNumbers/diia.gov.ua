<?php

namespace KitSoft\MultiLanguage\Extensions;

use Validator;

class ValidatorExtension
{
	/**
	 * __construct
	 */
	public function __construct() {
		Validator::extend('transUnique', 'KitSoft\MultiLanguage\Classes\Validators@uniqueTranlated');
        Validator::replacer('transUnique', 'KitSoft\MultiLanguage\Classes\Validators@uniqueTranlatedMessage');
	}
}
