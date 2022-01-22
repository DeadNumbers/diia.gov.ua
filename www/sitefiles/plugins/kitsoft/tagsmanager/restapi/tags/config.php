<?php 

/**
 * see /plugins/kitsoft/restapi/readme.md
 */

return [
	'model' => 'KitSoft\TagsManager\Models\Tag',
	'actions' => [
		'index' => [],
		'show' => [],
		'store' => [
			'fields' => [
				'name' => 'required|string',
				'slug' => 'required|string',
				'description' => 'string'
			],
		],
		'update' => [
			'fields' => [
				'name' => 'filled|string',
				'slug' => 'filled|string',
				'description' => 'string'
			],
		],
		'destroy' => []
	]
];