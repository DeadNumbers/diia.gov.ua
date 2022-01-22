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
            'questions_index' => 'Доступ до запитань',
            'categories_index' => 'Доступ до категорій',
            'inbox_show' => 'Показати вхідні в боковому меню',
        ],
    ],
    'side_menu' => [
        'inbox' => 'Вхідні',
        'questions' => 'Запитання',
        'categories' => 'Категорії',
    ],
    'question' => [
        'tabs' => [
            'main' => 'Головне',
        ],
        'fields' => [
            'question' => 'Запитання',
            'answer' => 'Відповідь',
            'link' => 'Посилання',
            'published' => 'Опубліковано',
            'answer_type' => 'Тип віповіді',
            'answer_type_options' => [
              'answer' => 'Контент',
              'link' => 'Зовнішнє посилання',
            ],
            'categories' => 'Категорії',
        ],
        'columns' => [
            'id' => 'ID',
            'question' => 'Запитання',
            'published' => 'Опубліковано',
            'categories' => 'Категорії',
            'created_at' => 'Створено',
        ],
    ],
    'category' => [
        'fields' => [
            'name' => 'Заголовок',
            'slug' => 'Посилання',
        ],
        'columns' => [
            'id' => 'ID',
            'name' => 'Заголовок',
            'slug' => 'Посилання',
        ],
    ],
    'buttons' => [
        'new_question' => 'Нове Запитання',
        'delete_selected' => 'Видалити обране',
        'create' => 'Створити',
        'create_and_close' => 'Створити та Закрити',
        'cancel' => 'Відмінити',
        'return_to_questions_list' => 'Повернутись до списку запитань',
        'save' => 'Зберегти',
        'save_and_close' => 'Зберегти та Закрити',
        'return_to_categories_list' => 'Повернутись до списку категорій',
        'new_category' => 'Нова Категорія',
        'reorder' => 'Відсортувати',
    ],
    'labels' => [
        'questions' => 'Запитання',
        'question' => 'Запитання',
        'or' => 'або',
        'create_question' => 'Створити Запитання',
        'edit_question' => 'Редагувати Запитання',
        'preview_question' => 'Попередній перегляд Запитання',
        'manage_questions' => 'Керування Запитаннями',
        'categories' => 'Категорії',
        'reorder' => 'Відсортувати',
        'manage_categories' => 'Керування Категоріями',
        'category' => 'Категорія',
        'create_category' => 'Створити Категорію',
        'edit_category' => 'Редагувати Категорію',
        'preview_category' => 'Попередній перегляд Категорії',
    ],
    'alerts' => [
        'selected_questions_delete_confirm' => 'Ви впевнені, що бажаєте видилити обрані Запитання?',
        'item_question_delete_confirm' => 'Видалити це запитання?',
        'selected_categories_delete_confirm' => 'Ви впевнені, що бажаєте видилити обрані Категорії?',
        'item_category_delete_confirm' => 'Видалити цю категорію?',
    ],
];