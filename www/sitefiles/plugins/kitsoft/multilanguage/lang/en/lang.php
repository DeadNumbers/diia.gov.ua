<?php
return [
	'plugin' => [
		'name' => 'MultiLanguages',
		'description' => 'MultiLanguages Plugin',
		'manage_locales' => 'Manage Locales',
		'manage_messages' => 'Manage Messages'
	],
	'component' => [
		'name' => 'MultiLanguage',
		'description' => 'MultiLanguage component'
	],
	'switcher' => [
		'label' => 'Languages',
		'translates' => 'Translates:',
		'current_language' => 'Current Language:'
	],
	'locales' => [
		'label' => 'Locales',
		'create' => 'Create Locale',
		'update' => 'Update Locale',
		'list' => 'Manage languages',
		'hint' => 'Create new languages here for translating front-end content. The default language represents the content before it has been translated.',
		'make_entities' => 'Make Entities',
		'make_entities_confirm' => 'Confirm make entities?',
		'fields' => [
			'name' => 'Name',
			'code' => 'Code',
			'label' => 'Label',
			'is_default' => 'System Default',
			'is_enabled' => 'Enabled',
			'is_enabled_comment' => 'Disabled languages will not be available in the front-end.',
			'is_default_comment' => 'The default language represents the system content before translation.'
		]
	],
	'messages' => [
		'label' => 'Messages',
		'create' => 'Create Message',
		'update' => 'Update Message',
		'list' => 'Manage Messages',
		'make_entities_success' => 'make_entities_success',
		'fields' => [
			'message' => 'Messages',
			'translates' => 'Translates'
		],
		'scan_messages_link' => 'Scan',
		'import_rainlab' => 'Import RainLab Messages',
		'confirm_update_slugs' => 'Confirm import messages from plugin RainLab Translate?',
	],
	'validators' => [
		'slug_exist' => 'The slug has already been taken.'
	],
];