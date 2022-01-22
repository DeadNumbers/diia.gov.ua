<?php

return [
    'plugin' => [
        'name'        => 'Пошук',
        'description' => 'Налаштування пошуку та elastic'
    ],
    'elastic_index' => [
        'type'       => 'Тип',
        'index_name' => 'Назва індекса',
        'mapping'    => 'Mapping',
        'in_process' => 'Перебудовуємо індекс'
    ],
    'permissions' => [
        'tab' => 'Пошук',
        'access_settings' => 'Доступ до налаштувань Пошуку',
        'access_providers_settings' => 'Керування Провайдерами',
    ],
];