<?php

return [
    'plugin' => [
        'name' => 'Core',
        'description' => '',
    ],
    'app' => [
        'statusLabel' => 'Indexing the site',
        'mainTab' => 'Main',
        'analyticsTab' => 'Analytics',
        'GA' => 'Google Analytics',
        'GTM' => 'Google Tag Manager',
        'codeLabel' => 'The contents of the file',
        'descriptionTab' => 'FAQ'
    ],
    'domain_changing' => [
        'tabs' => [
            'main' => 'Main',
        ],
        'fields' => [
            'model' => 'Choose the model',
            'old_value' => 'The wanted value',
            'old_value_comment' => 'Example: http://olddomain.com',
            'new_value' => 'Target value',
            'new_value_comment' => 'Example: http://newdomain.com',
        ],
        'alerts' => [
            'confirm' => 'Start replacing?',
        ],
        'buttons' => [
            'replace' => 'Replace',
        ],
    ],
    'permissions' => [
        'manage_google_analytics' => 'Access to Google Analytics',
        'manage_robots_txt' => 'Access to Robots.txt',
        'manage_settings' => 'Access to settings',
        'manage_domain_changing' => 'Access to the replacement of a domain name in the content',
        'manage_sentry' => 'Access to Sentry',
    ],
];