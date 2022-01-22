<?php

return [
    'plugin' => [
        'name' => 'Core',
        'description' => '',
    ],
    'app' => [
        'statusLabel' => 'Індексація сайту',
        'mainTab' => 'Головна',
        'analyticsTab' => 'Аналітика',
        'GA' => 'Google Analytics',
        'GTM' => 'Google Tag Manager',
        'codeLabel' => 'Зміст файлу',
        'descriptionTab' => 'FAQ'
    ],
    'domain_changing' => [
        'tabs' => [
            'main' => 'Головне',
        ],
        'fields' => [
            'model' => 'Оберіть модель',
            'old_value' => 'Шукане значення',
            'old_value_comment' => 'Наприклад: http://olddomain.com',
            'new_value' => 'Цільове значення',
            'new_value_comment' => 'Наприклад: http://newdomain.com',
        ],
        'alerts' => [
            'confirm' => 'Розпочати заміну?',
        ],
        'buttons' => [
            'replace' => 'Замінити',
        ],
    ],
    'permissions' => [
        'manage_google_analytics' => 'Доступ до Google Analytics',
        'manage_robots_txt' => 'Доступ до Robots.txt',
        'manage_settings' => 'Доступ до налаштувань',
        'manage_domain_changing' => 'Доступ до заміни доменного імені у контенті',
        'manage_sentry' => 'Доступ до Sentry',
    ],
];