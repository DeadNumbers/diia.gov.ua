<?php
return [
	'plugin' => [
		'name' => 'Мультимовність',
		'description' => 'Плагін Мультимовність',
		'manage_locales' => 'Налаштування мов',
		'manage_messages' => 'Налаштування перекладів'
	],
	'component' => [
		'name' => 'Мультимовність',
		'description' => 'Компонент Мультимовність'
	],
	'switcher' => [
		'label' => 'Переклади',
		'translates' => 'Переклади:',
		'current_language' => 'Поточна Мова:'
	],
	'locales' => [
		'label' => 'Мови',
		'create' => 'Створити Мову',
		'update' => 'Оновити Мову',
		'list' => 'Управління мовами',
		'hint' => 'Create new languages here for translating front-end content. The default language represents the content before it has been translated.',
		'make_entities' => 'Створити зв\'язки',
		'make_entities_confirm' => 'Підтвердити створення зв\'язків?',
		'fields' => [
			'name' => 'Ім\'я',
			'code' => 'Код',
			'label' => 'Назва',
			'is_default' => 'За замовчуванням',
			'is_enabled' => 'Увімкнено',
			'is_enabled_comment' => 'Disabled languages will not be available in the front-end.',
			'is_default_comment' => '<p class="flash-message static error">Не рекомендовано змінювати для підсайтів з існуючим контентом!</p>'
		]
	],
	'messages' => [
		'label' => 'Переклади',
		'create' => 'Створити Переклад',
		'update' => 'Оновити Переклад',
		'list' => 'Управління Перекладами',
		'make_entities_success' => 'make_entities_success',
		'fields' => [
			'message' => 'Повідомлення',
			'translates' => 'Переклади'
		],
		'scan_messages_link' => 'Сканувати',
		'import_rainlab' => 'Імпорт RainLab Перекладів',
		'confirm_import' => 'Підтвердити імпорт перекладів з плагіну RainLab Translate?',
	],
	'validators' => [
		'slug_exist' => 'Така URL адреса вже існує.'
	],
];