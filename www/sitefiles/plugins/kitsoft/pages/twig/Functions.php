<?php

namespace KitSoft\Pages\Twig;

use KitSoft\Pages\Models\Page;
use KitSoft\Pages\Models\Partial;

class Functions {
	/**
     * partial
     */
    public static function partial($code) {
    	return Partial::where('code', $code)->first();
    }
}