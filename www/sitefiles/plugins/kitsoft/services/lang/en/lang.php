<?php return [
	'plugin' => [
		'name' => 'Services'
	],
	'service_form' => 'Question form',

	'components' => [
		'categories' => [
			'isTopFilter' => 'SHow only top'
		]
	],

	'categories' => [
		'title' => 'Categories',
		'reorder' => 'Reorder',
		'return' => 'Return to categories',
        'new_category' => 'New Category',
        'delete_selected' => 'Delete selected',
        'delete_confirm' => 'Are you sure, yo want to delete?',
        'create_category' => 'Create Category',
        'save_and_close' => 'Save and close',
        'cancel' => 'Cancel',
        'or' => ' or ',
        'create' => ' Create ',
        'create_and_close' => 'Create and close',
        'edit_category' => 'Edit Category',
        'save' => 'Save',
    ],

	'category' => [
		'name' => 'Title',
		'slug' => 'Slug',
        'services' => 'Services',
	],

    'subcategories' => [
        'title' => 'Subcategories',
        'new_subcategory' => 'New Sub Category',
        'delete_selected' => 'Delete selected',
        'delete_confirm' => 'Are you sure, yo want to delete?',
        'create' => ' Create ',
        'or' => ' or ',
        'cancel' => 'Cancel',
        'create_and_close' => 'Create and close',
        'save' => 'Save',
        'save_and_close' => 'Save and close',
        'edit_subcategory' => 'Edit Subcategory',
        'create_subcategory' => 'Create Subcategory',
    ],

    'subcategory' => [
		'name' => 'Title',
		'slug' => 'Slug',
 		'reorder' => 'Reorder',
 		'categories' => 'Categories',
 		'services' => 'Services',
		'description' => 'Description',
		'life_situations' => 'Life situations',
        'link_description' => 'Text'
	],

	'services' => [
		'title' => 'Services',
        'new_service' => 'New Service',
        'delete_selected' => 'Delete selected',
        'import' => 'Import',
        'import_services' => 'Import services',
        'save_and_close' => 'Save and close',
        'create_and_close' => 'Create and close',
        'cancel' => 'Cancel',
        'or' => ' or ',
        'create' => ' Create ',
        'create_service' => ' Create Service',
        'edit_service' => 'Edit Service',
        'save' => 'Save',
        'delete_confirm' => 'Are you sure, yo want to delete?',
    ],

	'service' => [
		'title' => 'Title',
		'categories' => 'Categories',
		'subcategories' => 'Subcategories',
		'description' => 'Description',
		'slug' => 'Slug',
		'content' => 'Content',
		'related_services' => 'Related services',
		'link' => 'Link',
		'target' => 'Open in new window',
		'published' => 'Published',
		'is_top' => 'Top',
		'type' => 'Type',
		'hits' => 'Hits',
		'action_hits' => 'Count of clicks online-mss-btn',
        'has_subcategories' => 'Has subcategories',
        'link_label' => 'Link label',
        'links' => "Related materials",
        'client_time' => 'Feed time',
        'register_time' => 'Check-in time',
        'link_description' => 'Link description',
        'image' => 'Image',
        'seo' => [
            'meta_title' => 'Meta Title',
            'meta_h1' => 'Meta H1',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'og_image' => 'Open Graph Image'
        ],
        'link_modal' => 'Modal window',
        'link_modal_text' => 'Text of the model window',
	],

	'life_situations' => [
		'title' => 'Life situations',
        'new_life_situations' => 'New Life Situation',
        'delete_selected' => 'Delete selected',
        'delete_confirm' => 'Are you sure, yo want to delete?',
        'return' => 'Return',
        'create' => ' Create ',
        'create_and_close' => 'Create and close',
        'or' => ' or ',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'save_and_close' => 'Save and close',
        'edit_life_situation' => 'Edit Life Situation',
        'create_life_situation' => ' Create Life Situation',
    ],

	'life_situation' => [
		'title' => 'Title',
		'excerpt' => 'Description',
		'slug' => 'Slug',
		'services' => "Related services",
		'published' => 'Published',
		'parent' => 'Parent',
		'image' => 'Image',
		'subcategories' => 'Subcategories',
		'childs' => 'Childs',
		'content' => 'Content',
        'reorder' => 'Reorder',
        'seo' => [
            'meta_title' => 'Meta Title',
            'meta_h1' => 'Meta H1',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'og_image' => 'Open Graph Image'
        ]
	],

	'tabs' => [
		'subcategories' => 'Subcategories',
		'main' => 'Main',
		'related_services' => 'Related services',
		'categories' => 'Categories',
        'seo' => 'SEO',
        'description' => 'Description',
        'life_situations' => 'Life situations',
        'sections' => 'Sections',
        'services' => 'Services',
        'links' => "Related materials",
        'link' => 'Link',
        'image' => 'Image'
	],

	'permissions' => [
		'tab' => 'Services',
		'services' => 'Services',
		'categories' => 'Categories',
		'subcategories' => 'Subcategories',
		'access_publish' => 'Access for publish',
        'lifesituations' => 'Life situations'
	]
];