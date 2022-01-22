<?php
return [
	'plugin' => [
		'name' => 'Pages',
	],
	'page' => [
		'fields' => [
			'id' => 'ID',
			'title' => 'Title',
			'slug' => 'Slug',
			'content' => 'Content',
			'link_url' => 'Link Url',
			'link_target' => 'Link Target',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'published' => 'Published',
			'navigation_hidden' => 'Hide in Navigation',
			'components' => 'Components',
			'sections' => 'Sections',
			'layout' => 'Template',
			'sluggable' => 'Sluggable',
			'parent_id' => 'Parent ID',
			'preview' => 'Preview',
			'layout_content' => 'Template content',
			'og' => [
				'image' => 'Open Graph image'
			],
            'denied_users' => 'Deny page access',
            'granted_users' => 'Allow page access',
            'searchable' => 'Searchable'
		],
		'childs_not_found' => 'Childs not found',
		'tabs' => [
			'main' => 'Main',
			'options' => 'Options',
			'seo' => 'Seo',
			'builder' => 'Builder',
			'childs' => 'Childs pages',
            'access' => 'Access',
        ],
	],
	'pages' => [
		'name' => 'Page',
		'create' => 'New Page',
		'update' => 'Update Page',
		'preview' => 'Preview Page',
		'manage' => 'Manage Pages',
		'create_btn' => 'Create',
		'create_and_close_btn' => 'Create and Close',
		'save_btn' => '<u>S</u>ave',
		'save_and_close_btn' => 'Save and Close',
		'or' => 'or',
		'cancel' => 'Cancel',
		'delete_confirm' => 'Are you sure you want to delete the selected Pages?',
		'delete_selected' => 'Delete Selected',
		'reorder' => 'Reorder Pages',
		'return_pages' => 'Return to Pages',
        'before_save' => 'Please Save Page before load media'
    ],
	'menu' => [
		'name' => 'Menu',
		'return_to_list' => 'Return to the menu list',
		'index' => 'Menu index',
		'add_item' => 'Add Item',
		'reorder_items' => 'Reorder',
		'delete_confirm' => 'Confirm delete?',
		'delete' => 'Delete',
		'manage' => 'Manage Menu',
		'save_before_use_relation' => 'Please Save before use relation',
		'reorder' => 'Reorder',
		'fields' => [
			'id' => 'ID',
			'name' => 'Name',
			'code' => 'Code',
			'title' => 'Title',
			'items' => 'Items'
		],
		'tabs' => [
			'main' => 'Main',
		],
		'items' => 'Menu Item'
	],
	'menuitems' => [
		'add_item' => 'Create Menu',
		'return' => 'Return to Menu Items list',
		'reorder' => 'Reorder',
		'fields' => [
            'code' => 'Code',
            'title' => 'Title',
			'type' => 'Type',
			'isHidden' => 'Hidden',
			'isExternal' => 'External Link',
			'value' => 'Value',
			'value_link' => 'Value Link',
			'icon' => 'Icon'
		],
		'types' => [
			'header' => 'Header',
			'link' => 'Link',
			'page' => 'Page',
			'cmsPage' => 'Cms Page',
		]
	],
	'components' => [
		'menu' => [
			'name' => 'Menu',
			'description' => 'Menu Component',
		],
		'page' => [
			'name' => 'Page',
			'description' => 'Page Component',
		],
        'lastPages' => [
            'name' => 'Last pages block',
            'description' => 'Component of the last pages created',
            'fields' => [
                'count' => 'Count',
                'label' => 'Label "Last Pages"',
                'buttonLabel' => 'Label "All Pages"',
                'buttonLink' => 'Link',
            ],
            'mainTab' => 'Options',
        ],
		'plugin_name' => 'Plugin Name',
		'name' => 'Components',
		'new_component' => 'New Component',
		//'delete_selected' => '',
		'add' => 'Add Component',
		'return_to_components' => 'Return to Components',
		'edit' => 'Edit',
		'reorder' => 'Reorder Components',
		'manage' => 'Manage Components',
		'fields' => [
			'name' => 'Name',
			'alias' => 'Alias',
		],
		'tabs' => [
			'properties' => 'Properties',
		]
	],
	'return_to_page' => 'Retur to Page',
	'sections' => [
		'new' => 'New Section',
		'add' => 'Add Section',
		'create' => 'Create',
		'edit' => 'Edit',
		'reorder' => 'Reorder Sections',
		'fields' => [
			'name' => 'Code',
			'title' => 'Title'
		]
	],
	'partials' => [
		'name' => 'Partials',
		'new' => 'New',
		'manage' => 'Manage Partials',
        'create' => 'Create Partial',
        'edit' => 'Edit Partial',
		'fields' => [
			'title' => 'Title',
			'code' => 'Code',
		]
	],
	'backend_toolbar' => [
		'edit' => 'Edit'
	],
    'permissions' => [
        'pages' => [
            'index'  => 'Access to Pages',
            'create' => 'Access to create Pages',
            'delete' => 'Access to delete system Pages',
            'isSystemFields' => 'Access to edit the System Pages fields',
        ],
        'menu' => [
            'index'  => 'Access to Menu',
            'create' => 'Access to create Menu',
        ],
        'partials' => [
            'index'  => 'Access to Partials',
            'create' => 'Access to create Partials',
        ],
        'components' => [
            'create' => 'Access to create Components',
        ],
        'sections' => [
            'create' => 'Access to create Sections',
        ],
    ],
];