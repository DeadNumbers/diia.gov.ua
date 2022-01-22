<?php

return [
    'plugin' => [
        'name' => 'FAQ',
        'description' => '',
    ],
    'permissions' => [
        'tabs' => [
            'faq' => 'Faq',
        ],
        'fields' => [
            'questions_index' => 'Доступ к вопросам',
            'categories_index' => 'Доступ к категориям',
            'inbox_show' => 'Показать входящие в боковом меню',
        ],
    ],
    'side_menu' => [
        'inbox' => 'Входящие',
        'questions' => 'Вопросы',
        'categories' => 'Категории',
    ],
    'question' => [
        'tabs' => [
            'main' => 'Главное',
        ],
        'fields' => [
            'question' => 'Вопрос',
            'answer' => 'Ответ',
            'link' => 'Ссылка',
            'published' => 'Опубликовано',
            'answer_type' => 'Тип ответа',
            'answer_type_options' => [
                'answer' => 'Контент',
                'link' => 'Внешняя ссылка',
            ],
            'categories' => 'Категории',
        ],
        'columns' => [
            'id' => 'ID',
            'question' => 'Вопрос',
            'published' => 'Опубликовано',
            'categories' => 'Категории',
            'created_at' => 'Создано',
        ],
    ],
    'category' => [
        'fields' => [
            'name' => 'Заголовок',
            'slug' => 'Ссылка',
        ],
        'columns' => [
            'id' => 'ID',
            'name' => 'Заголовок',
            'slug' => 'Ссылка',
        ],
    ],
    'buttons' => [
        'new_question' => 'Новый Вопрос',
        'delete_selected' => 'Удалить выбранное',
        'create' => 'Создать',
        'create_and_close' => 'Создать и Закрыть',
        'cancel' => 'Отменить',
        'return_to_questions_list' => 'Вернуться к списку вопросов',
        'save' => 'Сохранить',
        'save_and_close' => 'Сохранить и Закрыть',
        'return_to_categories_list' => 'Вернуться к списку категорий',
        'new_category' => 'Новая Категория',
        'reorder' => 'Отсортировать',
    ],
    'labels' => [
        'questions' => 'Вопросы',
        'question' => 'Вопрос',
        'or' => 'или',
        'create_question' => 'Создать Вопрос',
        'edit_question' => 'Редактировать Вопрос',
        'preview_question' => 'Предпросмотр Вопроса',
        'manage_questions' => 'Управление Вопросами',
        'categories' => 'Категории',
        'reorder' => 'Отсортировать',
        'manage_categories' => 'Упрвление Категориями',
        'category' => 'Категория',
        'create_category' => 'Создать Категорию',
        'edit_category' => 'Редактировать Категорию',
        'preview_category' => 'Предпросмотр Категории',
    ],
    'alerts' => [
        'selected_questions_delete_confirm' => 'Вы уверены, что желаете удалить выбранные вопросы?',
        'item_question_delete_confirm' => 'Удалить этот вопрос?',
        'selected_categories_delete_confirm' => 'Ви уверены, что желаете удалить выбранные Категории?',
        'item_category_delete_confirm' => 'Удалить эту категорию?',
    ],
];