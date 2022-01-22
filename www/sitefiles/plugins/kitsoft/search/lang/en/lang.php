<?php

return [
    'plugin' => [
        'name'        => 'Search',
        'description' => 'Manage search and elastic'
    ],
    'elastic_index' => [
        'type'       => 'Type',
        'index_name' => 'Index name',
        'mapping'    => 'Mapping',
        'in_process' => 'In process'
    ],
    'permissions' => [
        'tab' => 'Search',
        'access_settings' => 'Access to Search settings',
        'access_providers_settings' => 'Manage Providers',
    ],
];