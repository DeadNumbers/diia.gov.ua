<?php

return [
    'filters' => [
        'key' => 'string',
        'type' => 'string'
    ],
    'paginate' => 5,
    'providers' => [

        'news' => [
            'model' => RainLab\Blog\Models\Post::class,
            'providers' => [
                'eloquent' => KitSoft\Search\Providers\Eloquent\NewsProvider::class,
                'elastic' => KitSoft\Search\Providers\Elastic\NewsProvider::class,
            ],
            'collection' => 'news',
            'scopes' => ['isPublished'],
            'searchableColumns' => ['title', 'content'],
            'publicFields' => ['slug', 'published', 'published_at'],
            'orderBy' => ['published_at', 'desc'],
            'paginate' => 5,
            'mappings' => [
                '@timestamp' => ['type' => 'date'],
                'id' => ['type' => 'long'],
                'site_id' => ['type' => 'keyword'],
                'title' => ['type' => 'text', 'fields' => ['standart' => ['type' => 'text']], 'analyzer' => 'standard'],
                'content' => ['type' => 'text', 'fields' => ['standart' => ['type' => 'text']], 'analyzer' => 'standard'],
                'excerpt' => ['type' => 'text', 'fields' => ['standart' => ['type' => 'text']], 'analyzer' => 'standard'],
                'published' => ['type' => 'boolean'],
                'published_at' => ['type' => 'date'],
                'slug' => ['type' => 'keyword', 'ignore_above' => 512],
                'tag_slugs' => ['type' => 'text', 'fields' => ['key' => [
                    'type' => 'keyword',
                    'ignore_above' => 256
                ]]]
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0
            ]
        ],

        'events' => [
            'model' => KitSoft\Events\Models\Event::class,
            'providers' => [
                'eloquent' => KitSoft\Search\Providers\Eloquent\EventsProvider::class,
                'elastic' => KitSoft\Search\Providers\Elastic\EventsProvider::class,
            ],
            'collection' => 'events',
            'scopes' => ['isPublished'],
            'searchableColumns' => ['title', 'content_html'],
            'publicFields' => ['published_at', 'slug'],
            'orderBy' => ['published_at', 'desc'],
            'mappings' => [
                '@timestamp' => ['type' => 'date'],
                'id' => ['type' => 'long'],
                'site_id' => ['type' => 'keyword'],
                'slug' => ['type' => 'keyword', 'ignore_above' => 512],
                'title' => ['type' => 'text', 'analyzer' => 'standard'],
                'excerpt' => ['type' => 'text', 'analyzer' => 'standard'],
                'content_html' => ['type' => 'text', 'analyzer' => 'standard'],
                'published' => ['type' => 'boolean'],
                'published_at' => ['type' => 'date'],
                'dt_from' => ['type' => 'date'],
                'dt_to' => ['type' => 'date'],
                'tag_slugs' => ['type' => 'text', 'fields' => ['key' => [
                    'type' => 'keyword',
                    'ignore_above' => 256
                ]]]
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0
            ]
        ],

        'npa' => [
            'providers' => [
                'eloquent' => KitSoft\Search\Providers\Eloquent\NpaProvider::class,
                'elastic' => KitSoft\Search\Providers\Elastic\NpaProvider::class,
            ],
            'model' => KitSoft\NPA\Models\Act::class,
            'collection' => 'npa',
            'scopes' => ['isPublished'],
            'searchableColumns' => ['title', 'html_content'],
            'publicFields' => ['published_at', 'no', 'creation_date', 'link_content', 'slug', 'category_id', 'session_id', 'convocation_id'],
            'orderBy' => ['published_at', 'desc'],
            'mappings' => [
                '@timestamp' => ['type' => 'date'],
                'id' => ['type' => 'long'],
                'site_id' => ['type' => 'keyword'],
                'slug' => ['type' => 'keyword', 'ignore_above' => 512],
                'title' => ['type' => 'text', 'analyzer' => 'standard'],
                'category_id' => ['type' => 'long'],
                'no' => [
                    'type' => 'text',
                    'analyzer' => 'analyzer_with_char_filter',
                    'fields' => [
                        'keyword' => [
                            'type' => 'keyword',
                            'ignore_above' => 256
                        ]
                    ]
                ],
                'content_type' => ['type' => 'keyword', 'ignore_above' => 25],
                'excerpt' => ['type' => 'text', 'analyzer' => 'standard'],
                'html_content' => ['type' => 'text', 'analyzer' => 'standard'],
                'published' => ['type' => 'boolean'],
                'published_at' => ['type' => 'date'],
                'created_at' => ['type' => 'date'],
                'creation_date' => ['type' => 'date'],
                //'source_id' => ['type' => 'long'],
                'tag_slugs' => ['type' => 'text', 'fields' => ['key' => [
                    'type' => 'keyword',
                    'ignore_above' => 256
                ]]]
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0,
                'analysis' => [
                    'analyzer' => [
                        'analyzer_with_char_filter' => [
                            'filter' => ['lowercase', 'asciifolding'],
                            'char_filter' => ['my_mapping'],
                            'tokenizer' => 'standard'
                        ]
                    ],
                    'char_filter' => [
                        'my_mapping' => [
                            'type' => 'mapping',
                            'mappings' => [
                                'П => p',
                                'п => p',
                                'р => p',
                                'Р => p',
                                'P => p'
                            ]
                        ]
                    ]
                ]
            ]
        ],

        'persons' => [
            'providers' => [
                'eloquent' => KitSoft\Search\Providers\Eloquent\PersonsProvider::class,
                'elastic' => KitSoft\Search\Providers\Elastic\PersonsProvider::class,
            ],
            'model' => KitSoft\Persons\Models\Person::class,
            'collection' => 'persons',
            'scopes' => [],
            'searchableColumns' => ['first_name', 'last_name', 'middle_name', 'bio'],
            'publicFields' => ['slug'],
            'mappings' => [
                '@timestamp' => ['type' => 'date'],
                'id' => ['type' => 'long'],
                'site_id' => ['type' => 'keyword'],
                'slug' => ['type' => 'keyword', 'ignore_above' => 512],
                'first_name' => ['type' => 'text', 'analyzer' => 'standard'],
                'last_name' => ['type' => 'text', 'analyzer' => 'standard'],
                'middle_name' => ['type' => 'text', 'analyzer' => 'standard'],
                'title' => ['type' => 'text', 'analyzer' => 'standard'],
                'position' => ['type' => 'text'],
                'bio' => ['type' => 'text'],
                'tag_slugs' => ['type' => 'text', 'fields' => ['key' => [
                    'type' => 'keyword',
                    'ignore_above' => 256
                ]]]
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0
            ]
        ],

        'mediagalleries' => [
            'providers' => [
                'eloquent' => KitSoft\Search\Providers\Eloquent\MediaGalleriesProvider::class,
                'elastic' => KitSoft\Search\Providers\Elastic\MediaGalleriesProvider::class,
            ],
            'model' => KitSoft\MediaGallery\Models\MediaGallery::class,
            'collection' => 'mediagalleries',
            'scopes' => ['isPublished'],
            'searchableColumns' => ['title'],
            'publicFields' => ['slug', 'type', 'published', 'published_at'],
            'orderBy' => ['published_at', 'desc'],
            'mappings' => [
                'site_id' => ['type' => 'keyword'],
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0
            ]
        ],

        'services' => [
            'providers' => [
                'eloquent' => KitSoft\Search\Providers\Eloquent\ServicesProvider::class,
                'elastic' => KitSoft\Search\Providers\Elastic\ServicesProvider::class,
            ],
            'model' => KitSoft\Services\Models\Service::class,
            'collection' => 'services',
            'searchableColumns' => ['name', 'content'],
            'scopes' => [],
            'publicFields' => ['slug'],
            'mappings' => [
                '@timestamp' => ['type' => 'date'],
                'id' => ['type' => 'long'],
                'site_id' => ['type' => 'keyword'],
                'name' => ['type' => 'text', 'analyzer' => 'standard'],
                'content' => ['type' => 'text', 'analyzer' => 'standard'],
                'slug' => ['type' => 'keyword', 'ignore_above' => 512],
                'tag_slugs' => ['type' => 'text', 'fields' => ['key' => [
                    'type' => 'keyword',
                    'ignore_above' => 256
                ]]]
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0
            ]
        ],

        'meetings' => [
            'model' => KitSoft\Meetings\Models\Meeting::class,
            'collection' => 'meetings',
            'searchableColumns' => ['title'],
            'scopes' => ['isPublished'],
            'publicFields' => ['slug', 'published_at'],
            'mappings' => [
                '@timestamp' => ['type' => 'date'],
                'id' => ['type' => 'long'],
                'site_id' => ['type' => 'keyword'],
                'slug' => ['type' => 'keyword', 'ignore_above' => 512],
                'title' => ['type' => 'text', 'analyzer' => 'standard'],
                'excerpt' => ['type' => 'text', 'analyzer' => 'standard'],
                'content_html' => ['type' => 'text', 'analyzer' => 'standard'],
                'published' => ['type' => 'boolean'],
                'published_at' => ['type' => 'date'],
                'dt_from' => ['type' => 'date'],
                'address' => ['type' => 'text', 'analyzer' => 'standard'],
                'tag_slugs' => ['type' => 'text', 'fields' => ['key' => [
                    'type' => 'keyword',
                    'ignore_above' => 256
                ]]]
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0
            ]
        ],

        'pages' => [
            'providers' => [
                'eloquent' => KitSoft\Search\Providers\Eloquent\PagesProvider::class,
                'elastic' => KitSoft\Search\Providers\Elastic\PagesProvider::class,
            ],
            'model' => KitSoft\Pages\Models\Page::class,
            'collection' => 'pages',
            'searchableColumns' => ['title'],
            'scopes' => ['isPublished', 'isNotSluggable'],
            'publicFields' => ['id', 'slug', 'parent_id', 'published_at'],
            'customUrl' => true,
            'mappings' => [
                '@timestamp' => ['type' => 'date'],
                'id' => ['type' => 'long'],
                'site_id' => ['type' => 'keyword'],
                'title' => ['type' => 'text', 'analyzer' => 'standard'],
                'content' => ['type' => 'text', 'analyzer' => 'standard'],
                'published' => ['type' => 'boolean'],
                'sluggable' => ['type' => 'boolean'],
                'url' => ['type' => 'keyword', 'ignore_above' => 1024],
                'slug' => ['type' => 'keyword', 'ignore_above' => 512],                
                'tag_slugs' => ['type' => 'text', 'fields' => ['key' => [
                    'type' => 'keyword',
                    'ignore_above' => 256
                ]]]
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0
            ]
        ]

    ],

    'elastic_settings' => [
        // date fields to convert when put at elastic index
        // when send date with default format, elastic client failed with error
        'date_convert' => [
            'published_at',
            'creation_date',
            'updated_at',
            'created_at',
            'dt_from',
            'dt_to'
        ],
        'remove_html' => [
            'content_html',
            'html_content',
            'content',
            'excerpt'
        ],
        'generate_url' => [
            'url' => 'fullUrl'
        ]
    ]
];