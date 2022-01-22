<?php return [
	'plugin' => [
		'name' => 'Сервіси'
	],
	'service_form' => 'Форма запитання',

	'components' => [
		'categories' => [
			'isTopFilter' => 'Відображати тільки закріплені'
		],
		'topservices' => [
			'count' => 'Кількість'
		]
	],

	'categories' => [
		'title' => 'Категорії',
		'reorder' => 'Відсортувати',
		'return' => 'Повернутися до категорій',
		'new_category' => 'Нова категорія',
        'delete_selected' => 'Видалити обрані',
        'delete_confirm' => 'Ви впевнені, що хочете видалити?',
        'create_category' => 'Створити Категорію',
        'save_and_close' => 'Зберегти і закрити',
        'create' => ' Створити ',
        'or' => ' або ',
        'cancel' => 'Відміна',
        'create_and_close' => 'Створити і закрити',
        'edit_category' => 'Редагувати Категорію',
        'save' => 'Зберегти',
    ],

	'category' => [
		'name' => 'Заголовок',
		'slug' => 'Посилання',
		'services' => 'Сервісів'
	],

    'subcategories' => [
        'title' => 'Підкатегорії',
        'new_subcategory' => 'Нова підкатегорія',
        'delete_selected' => 'Видалити обрані',
        'delete_confirm' => 'Ви впевнені, що хочете видалити?',
        'create' => ' Створити ',
        'create_and_close' => 'Створити і закрити',
        'or' => ' або ',
        'cancel' => 'Відміна',
        'save' => 'Зберегти',
        'save_and_close' => 'Зберегти і закрити',
        'edit_subcategory' => 'Редагувати підкатегорію',
        'create_subcategory' => 'Створити підкатегорію',
    ],

	'subcategory' => [
		'name' => 'Заголовок',
		'slug' => 'Посилання',
		'reorder' => 'Відсортувати',
		'categories' => 'Належить до категорій',
		'services' => 'Сервіси',
		'description' => 'Описання',
		'life_situations' => 'Життєві ситуації',
		'link_description' => 'Текст'
	],

	'services' => [
		'title' => 'Сервіси',
        'new_service' => 'Новий сервіс',
        'save_and_close' => 'Зберегти і закрити',
        'create_and_close' => 'Створити і закрити',
        'delete_selected' => 'Видалити обрані',
        'import' => 'Імпорт',
        'import_services' => 'Імпортувати сервіси',
        'cancel' => 'Відміна',
        'or' => ' або ',
        'create' => ' Створити ',
        'create_service' => 'Створити Сервіс',
        'edit_service' => 'Редагувати Сервіс',
        'save' => 'Зберегти',
        'delete_confirm' => 'Ви впевнені, що хочете видалити?',
    ],

	'service' => [
		'title' => 'Заголовок',
		'subcategories' => 'Підкатегорії',
		'description' => 'Описання',
		'slug' => 'Посилання',
		'content' => 'Контент',
		'related_services' => "Пов'язані послуги",
		'link' => 'Адреса посилання',
		'target' => 'Відкрити у новому вікні',
		'published' => 'Опубліковано',
		'is_top' => 'Закріплено',
		'type' => 'Тип',
		'reorder_subcategories' => 'Відсортувати',
		'has_subcategories' => 'Належить до підкатегорій',
		'links' => "Пов'язані матеріали",
		'hits' => 'Переглядів',
		'action_hits' => 'Кількість натискань online-mss-btn',
		'client_time' => 'Часу на подачу',
		'register_time' => 'Часу на реєстрацію',
		'link_description' => 'Описання посилання',
		'image' => 'Зображення',
        'seo' => [
            'meta_title' => 'Мета Заголовок',
            'meta_h1' => 'Мета Заголовок сторінки',
            'meta_description' => 'Мета Опис',
            'meta_keywords' => 'Мета Ключові слова',
            'og_image' => 'Open Graph зображення'
        ],
        'link_label' => 'Заголовок посилання',
        'link_modal' => 'Модальне вікно',
        'link_modal_text' => 'Текст модального вікна',
	],

	'life_situations' => [
		'title' => 'Життєві ситуації',
        'new_life_situations' => 'Нова життєва ситуація',
        'delete_selected' => 'Видалити обрані',
        'delete_confirm' => 'Ви впевнені, що хочете видалити?',
        'return' => 'Повернутися',
        'create' => ' Створити ',
        'create_and_close' => 'Створити і закрити',
        'or' => ' або ',
        'cancel' => 'Відміна',
        'save_and_close' => 'Зберегти і закрити',
        'save' => 'Зберегти',
        'create_life_situation' => 'Створити Життєву ситуацію',
        'edit_life_situation' => 'Редагувати Життєву ситуацію',
    ],

	'life_situation' => [
		'title' => 'Заголовок',
		'excerpt' => 'Описання',
		'slug' => 'Посилання',
		'services' => "Пов'язані послуги",
		'published' => 'Опубліковано',
		'parent' => 'Батьківська сторінка',
		'image' => 'Зображення',
		'subcategories' => 'Підкатегорії',
		'childs' => 'Дочірні сторінки',
		'content' => 'Контент',
        'reorder' => 'Відсортувати',
        'seo' => [
            'meta_title' => 'Мета Заголовок',
            'meta_h1' => 'Мета Заголовок сторінки',
            'meta_description' => 'Мета Опис',
            'meta_keywords' => 'Мета Ключові слова',
            'og_image' => 'Open Graph зображення'
        ]
	],

	'tabs' => [
		'subcategories' => 'Підкатегорії',
		'main' => 'Контент',
		'related_services' => "Пов'язані послуги",
		'categories' => 'Категорії',
		'services' => 'Сервіси',
		'description' => 'Описання',
		'links' => "Пов'язані матеріали",
        'seo' => 'SEO',
        'life_situations' => 'Життєві ситуації',
        'sections' => 'Секції',
        'link' => 'Посилання',
        'image' => 'Зображення'
	],

	'permissions' => [
		'tab' => 'Сервіси',
		'services' => 'Сервіси',
		'categories' => 'Категорій',
		'subcategories' => 'Підкатегорії',
		'access_publish' => 'Доступ до публікації',
		'lifesituations' => 'Життєві ситуації'
	]
];