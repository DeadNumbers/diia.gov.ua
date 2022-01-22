<?php

return [
	'limit' => 50000,
	'chunk' => 100,
	'models' => [
		'pages' => [
			'model' => KitSoft\Pages\Models\Page::class,
			'scopes' => ['isPublished', 'isNotSluggable', 'isSearchable'],
			'orderBy' => ['published_at', 'desc']
		],
		'acts' => [
			'model' => KitSoft\NPA\Models\Act::class,
			'scopes' => ['isPublished'],
			'orderBy' => ['published_at', 'desc']
		],
		'services' => [
			'model' => KitSoft\Services\Models\Service::class,
			'scopes' => ['isPublished'],
			'orderBy' => ['created_at', 'desc']
		],
		'posts' => [
			'model' => RainLab\Blog\Models\Post::class,
			'scopes' => ['isPublished'],
			'orderBy' => ['published_at', 'desc']
		],
		'events' => [
			'model' => KitSoft\Events\Models\Event::class,
			'scopes' => ['isPublished'],
			'orderBy' => ['published_at', 'desc']
		],
		'mediagalleries' => [
			'model' => KitSoft\MediaGallery\Models\MediaGallery::class,
			'scopes' => ['isPublished'],
			'orderBy' => ['published_at', 'desc']
		],
		'ministries' => [
			'model' => KitSoft\Ministries\Models\Ministry::class,
			'scopes' => [],
			'orderBy' => ['published_at', 'desc']
		],
		'persons' => [
			'model' => KitSoft\Persons\Models\Person::class,
			'scopes' => [],
			'orderBy' => ['sort_order', 'asc']
		],
		'meetings' => [
			'model' => KitSoft\Meetings\Models\Meeting::class,
			'scopes' => ['isPublished'],
			'orderBy' => ['published_at', 'desc']
		],
		'tags' => [
			'model' => KitSoft\TagsManager\Models\Tag::class,
			'scopes' => [],
			'orderBy' => ['created_at', 'desc']
		],
		'faq' => [
			'model' => KitSoft\Faq\Models\Question::class,
			'scopes' => ['isPublished'],
			'orderBy' => ['created_at', 'desc']
		]
	]
];