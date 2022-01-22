<?php

return [
	'types' => [
		'news' => [
			'title' => 'Новини',
			'model' => 'RainLab\Blog\Models\Post',
			'scopes' => ['isPublished'],
			'order' => [
				'published_at' => 'desc'
			]
		],
		'events' => [
			'title' => 'Події',
			'model' => 'KitSoft\Events\Models\Event',
			'scopes' => ['isPublished', 'nearest'],
			'order' => [
				'dt_from' => 'desc'
			]
		],
		'acts' => [
			'title' => 'Офіційні документи',
			'model' => 'KitSoft\NPA\Models\Act',
			'scopes' => ['isPublished'],
			'order' => [
				'published_at' => 'desc'
			]
		]
	],
	'drivers' => [
		'phplist' => [
			'class' => 'KitSoft\Digest\Drivers\PhpList'
		]
	]
];