<?php
return [
	'plugin' => [
		'name' => 'Мультиязычность',
		'description' => 'Плагин Мультиязычности',
		'manage_locales' => 'Настройки языков',
		'manage_messages' => 'Настройки переводов'
	],
	'component' => [
		'name' => 'Мультиязычность',
		'description' => 'Компонент Мультиязычности'
	],
	'switcher' => [
		'label' => 'Переводы',
		'translates' => 'Переводы:',
		'current_language' => 'Текущий Язык:'
	],
	'locales' => [
		'label' => 'Языки',
		'create' => 'Создать Язык',
		'update' => 'Обновить Язык',
		'list' => 'Управление языками',
		'hint' => 'Create new languages here for translating front-end content. The default language represents the content before it has been translated.',
		'make_entities' => 'Создать связи',
		'make_entities_confirm' => 'Подтвердить создание связей?',
		'fields' => [
			'name' => 'Имя',
			'code' => 'Код',
			'label' => 'Название',
			'is_default' => 'По умолчанию',
			'is_enabled' => 'Включено',
			'is_enabled_comment' => 'Disabled languages will not be available in the front-end.',
			'is_default_comment' => 'The default language represents the system content before translation.'
		]
	],
	'messages' => [
		'label' => 'Переводы',
		'create' => 'Создать Перевод',
		'update' => 'Обновить Перевод',
		'list' => 'Управление Переводами',
		'make_entities_success' => 'make_entities_success',
		'fields' => [
			'message' => 'Сообщение',
			'translates' => 'Переводы'
		],
		'scan_messages_link' => 'Сканировать',
		'import_rainlab' => 'Импорт RainLab Переводов',
		'confirm_import' => 'Подтвердить импорт переводов из плагина RainLab Translate?',
	],
	'validators' => [
		'slug_exist' => 'Такой URL адрес уже существует.'
	],
];