<?php return [
    'plugin' => [
        'name'        => 'Формы',
        'description' => '',
    ],

    'field' => [
        'tabs' => [

        ],
        'fields' => [
            'id'      => 'ID',
            'title'   => 'Название',
            'type'    => 'Тип',
            'code'    => 'Код',
            'rules'   => 'Валидация',
            'options' => 'Варианты',
            'options_prompt' => 'Добавить элемент',
            'rules_options'  => [
                'required'   => 'Обязательное',
                'numeric'    => 'Числовое',
                'email'      => 'Емейл',
                'recaptcha'  => 'Recaptcha',
                'image'      => 'Изображение',
                'limit'      => 'Ограничение длины',
                'min'        => 'Минимальное количество символов',
                'max'        => 'Максимальное количество символов',
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
                'title' => 'Название',
                'value' => 'Значение',
            ],
            'placeholder'     => 'Наполнитель',
            'file_extensions' => 'Типи файлов mimes',
            'file_extensions_comment' => 'Введите разрешенные типы через запятую<br>jpg,jpeg,zip,rar,etc.',
        ],
    ],

    'form' => [
        'tabs' => [
            'main'      => 'Главное',
            'send_mail' => 'Отправить на почту',
            'fields'    => 'Поля',
        ],
        'fields' => [
            'id'     => 'ID',
            'name'   => "Имя",
            'code'   => 'Код',
            'send'   => 'Отправить на почту',
            'fields' => 'Поля',
            'emails' => 'Емейлы',
            'emails_prompt' => 'Добавить емейл',
            'emails_form'   => [
                'email' => 'Емейл'
            ],
            'template'      => 'Шаблон',
            'description'   => 'Описание',
            'success_text'  => 'Текст успешной отправки',
            'submit_text'   => 'Текст на кнопке отправки',
            'template_comment' => 'Пример применения в шаблоне почты - {{ fields.name }}.',
            '' => '',
        ],
    ],

    'inbox' => [
        'tabs' => [

        ],
        'fields' => [
            'id' => 'ID',
            'ip' => 'IP Адрес',
            'form'   => 'Форма',
            'files'  => 'Файлы',
            'fields' => 'Поля',
            'date_to'      => 'Дата по',
            'date_from'    => 'Дата с',
            'created_at'   => 'Создано',
            'status_label' => 'Статус',
        ],
        'statuses' => [
            'new'     => 'Новый',
            'process' => 'В обробке',
            'closed'  => 'Закрытый',
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
            'forms' => 'Формы'
        ],
        'permissions' => [
            'manage_forms'    => 'Управление формами',
            'manage_inbox'    => 'Управление входящими',
            'access_settings' => 'Доступ к настройкам',
        ],
    ],

    'settings_menu' => [
        'tabs' => [
            'forms' => 'Формы',
        ],
        'menu' => [
            'inbox'    => 'Входящие',
            'forms'    => 'Формы',
            'settings' => 'Настройки',
        ],
    ],

    'system' => [
        'buttons' => [
            'save' => 'Сохранить',
            'back' => 'Вернуться',
            'new_field' => 'Новое Поле',
            'new_form'  => 'Новоа Форма',
            'add_field' => 'Добавить Поле',
            'reorder'   => 'Сортировать',
            'delete'    => 'Удалить',
            'create'    => 'Создать',
            'cancel'    => 'Отменить',
            'download'  => 'Загрузить',
            'export'    => 'Экспортировать',
            'delete_selected'  => 'Удалить выбранное',
            'back_to_form'     => 'Вернуться к форме',
            'create_and_close' => 'Создать и Закрыть',
            'save_and_close'   => 'Сохранить и Закрыть',
            'change_status'    => 'Изменить статус',
            'return_to_fields_list' => 'Вернуться к списку полей',
            'return_to_forms_list'  => 'Вернуться к списку форм',
        ],
        'labels' => [
            'or' => 'или',
            'field'   => 'Поле',
            'fields'  => 'Поля',
            'form'    => 'Форма',
            'forms'   => 'Формы',
            'inbox'   => 'Входящие',
            'inboxes' => 'Входящие',
            'create_field'   => 'Создать Поле',
            'create_form'    => 'Создать Форму',
            'edit_field'     => 'Редактировать Поле',
            'edit_form'      => 'Редактировать Форму',
            'preview_field'  => 'Предпросмотр Поля',
            'preview_form'   => 'Предпросмотр Формы',
            'preview_inbox'  => 'Предпросмотр Входящих',
            'manage_fields'  => 'Управление Полями',
            'manage_forms'   => 'Управление Формами',
            'manage_inboxes' => 'Управление Входящими',
            'reorder_fields' => 'Отсортировать Поля',
            'save_form_before_use'        => 'Пожалуйста сохрание форму перед использованием',
            'download_inboxes_for_period' => 'Вы можете загрузить входящие за выбранный период',
            '' => '',
        ],
        'alerts' => [
            'confirm_delete_fields'  => 'Вы уверены, что желаете удалить выбарнные Поля?',
            'confirm_delete_forms'   => 'Вы уверены, что желаете удалить выбарнные Формы?',
            'confirm_delete_inboxes' => 'Вы уверены, что желаете удалить выбарнные Входящие?',
            'confirm_change_status'  => 'Перевести в статус',
        ],
    ],

    'components' => [
        'form' => [
            'name'        => 'Форма',
            'description' => 'Компонента отображения формы по ее коду',
            'tabs' => [],
            'fields' => [
                'code' => 'Код Формы'
            ],
        ]
    ],

    'widgets' => [
        'unreaded_inboxes' => [
            'name' => 'Непрочитанные входящие',
            'statuses' => [
                'new_inboxes'    => 'Новых поступлений',
                'no_new_inboxes' => 'Новых поступлений нет',
            ],
        ],
    ],
];