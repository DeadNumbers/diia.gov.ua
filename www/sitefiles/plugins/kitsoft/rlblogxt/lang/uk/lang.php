<?php

return [
    'posts' => [
        'top'     => 'Топ',
        'fixed'   => 'Закріплена',
        'regular' => 'Звичайна',
        'hits'    => 'Перегляди',
    ],
    'category' => [
        'favourite' => 'Вибране',
    ],
    'post' => [
        'author'            => 'Автор',
        'is_author_visible' => 'Показувати автора',
        'authors'           => 'Автори',
        'preview'           => 'Попередній перегляд',
        'seo' => [
            'meta_title'       => 'Мета Заголовок',
            'meta_h1'          => 'Мета Заголовок сторінки',
            'meta_description' => 'Мета Опис',
            'meta_keywords'    => 'Мета Ключові слова',
            'og_image'         => 'Open Graph зображення',
        ],
    ],
    'components' => [
        'lastnews' => [
            'name'        => 'Останні новини | фільтр',
            'description' => 'Відображення останніх новин з можливістю фільтрації',
            'tabs' => [
                'main'       => 'Головне',
                'filters'    => 'Фільтри',
                'all_news'   => 'Усі новини',
                'categories' => 'Категорії',
            ],
            'fields' => [
                'count'    => 'Кількість новин',
                'is_top'   => 'Лише Топ',
                'is_fixed' => 'Лише зафіксовані',
                'posts_label'    => 'Заголовок блоку',
                'exclude_top'    => 'Виключити Топ',
                'button_link'    => 'Посилання на усі новини',
                'is_top_order'   => 'Спочатку Топ',
                'exclude_slug'   => 'Виключити поточну новину',
                'exclude_fixed'  => 'Виключити зафіксовані',
                'is_fixed_order' => 'Спочатку зафіксовані',
                'posts_categories_filter' => 'Включити до відображення такі категорії новин',
                'posts_categories_filter_comment' => '(залишити пустим для вибору всіх)'
            ],
        ],
        'categories' => [
            'name'        => 'Новини за категоріями',
            'description' => 'Формує виведення новин згідно обраних категорій',
            'tabs' => [
                'main'   => 'Головне',
                'filter' => 'Фільтр',
            ],
            'fields' => [
                'count'          => 'Кількість новин',
                'posts_label'    => 'Заголовок блоку',
                'add_fixed_news' => 'Закріплені новини',
                'post_categories_filter'     => 'Додати до відображення наступні категорії новин',
                'add_fixed_news_description' => 'Закріплені новини будуть відображатись на початку списку новин категорії',
            ],
        ],
        'posts' => [
            'name'        => 'Новини',
            'description' => 'Відображення каталогу новин згідно налаштувань та отриманих get-параметрів',
            'tabs' => [
                'main' => 'Головне',
            ],
            'fields' => [
                'count'          => 'Кількість',
                'posts_label'    => 'Заголовок блоку',
                'is_top_order'   => 'Спочатку Топ',
                'is_fixed_order' => 'Спочатку зафіксовані',
            ],
        ],
        'post' => [
            'name'        => 'Новина',
            'description' => 'Відображення поточної новини',
            'tabs' => [
                'related_news' => 'Зв\'язані новини',
            ],
            'fields' => [
                'load_related'  => 'Завантажити зв\'язані новини',
                'related_type'  => 'Фільтр',
                'related_count' => 'Кількість зв\'язаних новин',
                'related_type_options' => [
                    'tag'  => 'по першому тегу',
                    'tags' => 'по тегам',
                    'category'   => 'по першій категорії',
                    'categories' => 'по категоріям',
                ],
            ],
        ],
        'main_news' => [
            'name'        => 'Головні новини | Новини вибраних категорій',
            'description' => 'Відображення новин (з тегами), що належать вибраним категоріям',
            'tabs' => [
                'main' => 'Головне',
            ],
            'fields' => [
                'posts_count'      => 'Кількість новин',
                'categories_count' => 'Кількість категорій',
            ],
        ],
        'category' => [
            'name'        => 'Категорія',
            'description' => 'Відображення новин, що належать поточній категорії',
        ],
        'popular_news' => [
            'name'        => 'Популярні новини',
            'description' => 'Відображення новин з найбільшою кількістю переглядів',
            'tabs' => [
                'main' => 'Головне',
            ],
            'fields' => [
                'count' => 'Кількість новин',
            ],
        ],
        'external_news' => [
            'name'        => 'Зовнішні новини (API)',
            'description' => 'Отримання новин по зовнішньому API',
            'tabs' => [
                'main'   => 'Головне',
                'button' => 'Кнопка',
            ],
            'fields' => [
                'posts'   => 'Заголовок блоку',
                'count'   => 'Кількість',
                'api_url' => 'Адреса API',
                'target'  => 'Відкрити у новому вікні',
                'button_url'   => 'Посилання кнопки',
                'button_label' => 'Заголовок кнопки',
            ],
        ],
    ],
    'tab' => [
        'seo' => 'SEO',
    ],
    'rlblogxt' => [
        'menu_label'      => 'Автор',
        'create_author'   => 'Автора',
        'access_authors'  => 'Доступ до авторів',
        'manage_settings' => 'Керування налаштуваннями',
    ],
    'author' => [
        'name'             => 'Назва',
        'posts'            => 'Новини',
        'name_placeholder' => '',
        'slug'             => 'Адреса',
        'slug_placeholder' => '',
        'description'      => 'Опис',
        'uri'              => 'Посилання',
    ],
    'authors' => [
        'new_author' => 'Новий автор',
        'list_title' => 'Список',
        'labels'     => [
            'menu_label' => 'Автори',
        ],
        'successfully_deleted' => 'Видалено',
    ],
];