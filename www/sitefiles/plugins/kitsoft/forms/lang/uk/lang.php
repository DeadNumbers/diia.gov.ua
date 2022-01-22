<?php return [
    'plugin' => [
        'name'        => 'Форми',
        'description' => '',
    ],

    'field' => [
        'tabs' => [

        ],
        'fields' => [
            'id'      => 'ID',
            'title'   => 'Назва',
            'type'    => 'Тип',
            'code'    => 'Код',
            'rules'   => 'Валідація',
            'options' => 'Варіанти',
            'options_prompt' => 'Додати елемент',
            'rules_options'  => [
                'required'   => "Обов'язкове",
                'numeric'    => 'Числове',
                'email'      => 'Емейл',
                'recaptcha'  => 'Recaptcha',
                'image'      => 'Зображення',
                'limit'      => 'Обмеження довжини',
                'min'        => 'Мінімальна кількість символів',
                'max'        => 'Максимальна кількість символів',
            ],
            'type_options' => [
                'text'   => 'text',
                'file'   => 'file',
                'label'  => 'label',
                'radio'  => 'radio',
                'select' => 'select',
                'selecttree' => 'selecttree',
                'checkbox'  => 'checkbox',
                'multicheckbox'  => 'multicheckbox',
                'textarea'  => 'textarea',
                'recaptcha' => 'recaptcha',
                'phone' => 'phone'
            ],
            'options_form' => [
                'title' => 'Назва',
                'value' => 'Значення',
            ],
            'placeholder'     => 'Заповнювач',
            'file_extensions' => 'Типи файлів mimes',
            'file_extensions_comment' => 'Введіть дозволені типи через кому<br>jpg,jpeg,zip,rar,etc.',
        ],
    ],

    'form' => [
        'tabs' => [
            'main'      => 'Головне',
            'send_mail' => 'Відправити на пошту',
            'fields'    => 'Поля',
        ],
        'fields' => [
            'id'     => 'ID',
            'name'   => "Ім'я",
            'code'   => 'Код',
            'send'   => 'Відправити на пошту',
            'fields' => 'Поля',
            'emails' => 'Емейли',
            'emails_prompt' => 'Додати емейл',
            'emails_form'   => [
                'email' => 'Емейл'
            ],
            'template'      => 'Шаблон',
            'description'   => 'Опис',
            'success_text'  => 'Текст успішної відправки',
            'submit_text'   => 'Текст на кнопці відправки',
            'template_comment' => 'Приклад застосування в шаблоні пошти - {{ fields.name }}.',
        ],
    ],

    'inbox' => [
        'tabs' => [

        ],
        'fields' => [
            'id' => 'ID',
            'ip' => 'IP Адреса',
            'form'   => 'Форма',
            'files'  => 'Файли',
            'fields' => 'Поля',
            'date_to'      => 'Дата по',
            'date_from'    => 'Дата з',
            'created_at'   => 'Створено',
            'status_label' => 'Статус',
        ],
        'statuses' => [
            'new'     => 'Новий',
            'process' => 'В обробці',
            'closed'  => 'Закритий',
        ],
        'filters' => [
            'form'   => 'Форма',
            'status' => 'Статус',
        ],
    ],

    'settings' => [

    ],

    'permissions' => [
        'tabs' => [
            'forms' => 'Форми'
        ],
        'permissions' => [
            'manage_forms'    => 'Керування формами',
            'manage_inbox'    => 'Керування вхідними',
            'access_settings' => 'Доступ до налаштувань',
        ],
    ],

    'settings_menu' => [
        'tabs' => [
            'forms' => 'Форми',
        ],
        'menu' => [
            'inbox'    => 'Вхідні',
            'forms'    => 'Форми',
            'settings' => 'Налаштування',
        ],
    ],

    'system' => [
        'buttons' => [
            'save' => 'Зберегти',
            'back' => 'Повернутися',
            'new_field' => 'Нове Поле',
            'new_form'  => 'Нова Форма',
            'add_field' => 'Додати Поле',
            'reorder'   => 'Відсортувати',
            'delete'    => 'Видалити',
            'create'    => 'Створити',
            'cancel'    => 'Скасувати',
            'download'  => 'Завантажити',
            'export'    => 'Експортувати',
            'delete_selected'  => 'Видалити вибране',
            'back_to_form'     => 'Повернутися до форми',
            'create_and_close' => 'Створити і Закрити',
            'save_and_close'   => 'Зберегти і Закрити',
            'change_status'    => 'Змінити статус',
            'return_to_fields_list' => 'Повернутись до списку полів',
            'return_to_forms_list'  => 'Повернутись до списку форм',
            '' => '',
        ],
        'labels' => [
            'or' => 'або',
            'field'   => 'Поле',
            'fields'  => 'Поля',
            'form'    => 'Форма',
            'forms'   => 'Форми',
            'inbox'   => 'Вхідні',
            'inboxes' => 'Вхідні',
            'create_field'   => 'Створити Поле',
            'create_form'    => 'Створити Форму',
            'edit_field'     => 'Редагувати Поле',
            'edit_form'      => 'Редагувати Форму',
            'preview_field'  => 'Попередній перегляд Поля',
            'preview_form'   => 'Попередній перегляд Форми',
            'preview_inbox'  => 'Попередній перегляд Вхідних',
            'manage_fields'  => 'Керування Полями',
            'manage_forms'   => 'Керування Формами',
            'manage_inboxes' => 'Керування Вхідними',
            'reorder_fields' => 'Відсортувати Поля',
            'save_form_before_use'        => 'Будь ласка збережіть форму перед використанням',
            'download_inboxes_for_period' => 'Ви можете завантажити вхідні за обраний період',
            '' => '',
        ],
        'alerts' => [
            'confirm_delete_fields'  => 'Ви впевнені, що бажаєте видалити обрані Поля?',
            'confirm_delete_forms'   => 'Ви впевнені, що бажаєте видалити обрані Форми?',
            'confirm_delete_inboxes' => 'Ви впевнені, що бажаєте видалити обрані Вхідні?',
            'confirm_change_status'  => 'Перевести у статус',
        ],
    ],

    'components' => [
        'form' => [
            'name'        => 'Форма',
            'description' => 'Компонента відображення форми за її кодом',
            'tabs' => [],
            'fields' => [
                'code' => 'Код Форми'
            ],
        ]
    ],

    'widgets' => [
        'unreaded_inboxes' => [
            'name' => 'Непрочитані вхідні',
            'statuses' => [
                'new_inboxes'    => 'Нових надходжень',
                'no_new_inboxes' => 'Нових надходжень немає',
            ],
        ],
    ],

    'validation' => [
        "min"              => [
            "string"  => "Поле :attribute має бути довжиною не менше за :min символів(-ли)."
        ],
        "max"              => [
            "string"  => "Поле :attribute не має бути довшим за :max символів(-ли)."
        ],
    ]
];
