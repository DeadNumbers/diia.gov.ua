<?php
// settings models must be implemented in classes, not here
return [
	'models' => [
		// Digest
		'KitSoft\Digest\Models\ListSync',
		'KitSoft\Digest\Models\Subscriber',

		// Faq
		'KitSoft\Faq\Models\Category',
		'KitSoft\Faq\Models\Question',

		// Forms
		'KitSoft\Forms\Models\Field',
		'KitSoft\Forms\Models\Form',

		// Pages
	    'KitSoft\Pages\Models\Page',
	    'KitSoft\Pages\Models\Menu',
	    'KitSoft\Pages\Models\MenuItem',
	    'KitSoft\Pages\Models\Partial',
	    'KitSoft\Pages\Models\Section',
	    'KitSoft\Pages\Models\Component',

	    // Polls
	    'KitSoft\Polls\Models\Answer',
	    'KitSoft\Polls\Models\AnswerType',
	    'KitSoft\Polls\Models\Department',
	    'KitSoft\Polls\Models\Location',
	    'KitSoft\Polls\Models\Option',
	    'KitSoft\Polls\Models\Poll',
	    'KitSoft\Polls\Models\Question',

	    // Blog
	    'RainLab\Blog\Models\Post',
	    'RainLab\Blog\Models\Category',
	    'KitSoft\RLBlogXT\Models\Author',

	    // Npa
	    'KitSoft\Npa\Models\Act',
	    'KitSoft\Npa\Models\Author',
	    'KitSoft\Npa\Models\Category',
	    'KitSoft\Npa\Models\Status',

	    // Events
	    'KitSoft\Events\Models\Event',
	    'KitSoft\Events\Models\Author',
	    'KitSoft\Events\Models\Category',

	    // MediaGallery
	    'KitSoft\MediaGallery\Models\MediaGallery',
	    'KitSoft\MediaGallery\Models\Category',

	    // Persons
	    'KitSoft\Persons\Models\Person',
	    'KitSoft\Persons\Models\Group',

	    // Tagsmanager
	    'KitSoft\Tagsmanager\Models\Tag',

	    // TaxSystems
	    'KitSoft\TaxSystems\Models\EntrepreneurOption',
	    'KitSoft\TaxSystems\Models\EntrepreneurQuestion',
	    'KitSoft\TaxSystems\Models\TaxSystem',

	    // Meetings
	    'KitSoft\Meetings\Models\Author',
	    'KitSoft\Meetings\Models\Category',
	    'KitSoft\Meetings\Models\Committee',
	    'KitSoft\Meetings\Models\Meeting',

	    // Ministries
	    'KitSoft\Ministries\Models\Ministry',

	    // Services
	    'KitSoft\Services\Models\Service',
	    'KitSoft\Services\Models\Category',
	    'KitSoft\Services\Models\SubCategory',
	    'KitSoft\Services\Models\LifeSituation',

	    // Streaming
	    'KitSoft\Streaming\Models\Stream',

	    // MultiLanguage
	    'KitSoft\MultiLanguage\Models\Locale',
	    'KitSoft\MultiLanguage\Models\Message',
	    'KitSoft\MultiLanguage\Models\Field',

	    // MultiSite
	    'KitSoft\MultiSite\Models\Site',

	    // CacheRoute
	    'KitSoft\CacheRoute\Models\CacheRoute',
	],
	'controllers' => [
		'KitSoft\Pages\Controllers\Pages',
		'KitSoft\Pages\Controllers\Partials',
		'KitSoft\Pages\Controllers\Menus',

		'KitSoft\Faq\Controllers\Categories',
		'KitSoft\Faq\Controllers\Questions',

		'KitSoft\Digest\Controllers\Subscribers',

		'KitSoft\Forms\Controllers\Forms',

		'KitSoft\Polls\Controllers\Answers',
		'KitSoft\Polls\Controllers\Departments',
		'KitSoft\Polls\Controllers\Locations',
		'KitSoft\Polls\Controllers\Polls',
		'KitSoft\Polls\Controllers\Questions',

		'RainLab\Blog\Controllers\Posts',
		'RainLab\Blog\Controllers\Categories',
		'KitSoft\RLBlogXT\Controllers\Authors',

		'KitSoft\Services\Controllers\Services',
	    'KitSoft\Services\Controllers\Categories',
	    'KitSoft\Services\Controllers\SubCategories',
	    'KitSoft\Services\Controllers\LifeSituations',

	    'KitSoft\TaxSystems\Controllers\EntrepreneurQuestions',
	    'KitSoft\TaxSystems\Controllers\TaxSystems',
	]
];