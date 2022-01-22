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
                'title' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'content' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'excerpt' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'published' => ['type' => 'boolean'],
                'published_at' => ['type' => 'date'],
                'slug' => ['type' => 'keyword', 'ignore_above' => 512],
                'tag_slugs' => [
                    'type' => 'text',
                    'fields' => [
                        'keyword' => [
                            'type' => 'keyword',
                            'ignore_above' => 256
                        ],
                        'whitespace' => [
                            'type' => 'text',
                            'analyzer' => 'whitespace',
                            'fielddata' => true
                        ]
                    ]
                ]
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0,
                'analysis' => [
                    'filter' => [
                        'shingle' => [
                            'max_shingle_size' => 3,
                            'min_shingle_size' => 2,
                            'type' => 'shingle'
                        ]
                    ],
                    'analyzer' => [
                        'reverse' => [
                            'filter' => [
                                'reverse'
                            ],
                            'type' => 'custom',
                            'tokenizer' => 'standard'
                        ],
                        'trigram' => [
                            'filter' => [
                                'shingle'
                            ],
                            'type' => 'custom',
                            'tokenizer' => 'standard'
                        ]
                    ]
                ]
            ]
        ],

        'services' => [
            'providers' => [
                'eloquent' => KitSoft\Search\Providers\Eloquent\ServicesProvider::class,
                'elastic' => KitSoft\Search\Providers\Elastic\ServicesProvider::class,
            ],
            'model' => KitSoft\Services\Models\Service::class,
            'collection' => 'services',
            'searchableColumns' => ['title', 'description'],
            'scopes' => ['isPublished'],
            'publicFields' => ['slug'],
            'dynamicAttributes' => [
                'content' => 'sections_content'
            ],
            'mappings' => [
                '@timestamp' => ['type' => 'date'],
                'id' => ['type' => 'long'],
                'title' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'published' => ['type' => 'boolean'],
                'content' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'description' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'slug' => ['type' => 'keyword', 'ignore_above' => 512],
                'tag_slugs' => ['type' => 'text', 'fields' => ['key' => [
                    'type' => 'keyword',
                    'ignore_above' => 256
                ]]],
                'hits' => ['type' => 'long'],
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0,
                'analysis' => [
                    'filter' => [
                        'shingle' => [
                            'max_shingle_size' => 3,
                            'min_shingle_size' => 2,
                            'type' => 'shingle'
                        ]
                    ],
                    'analyzer' => [
                        'reverse' => [
                            'filter' => [
                                'reverse'
                            ],
                            'type' => 'custom',
                            'tokenizer' => 'standard'
                        ],
                        'trigram' => [
                            'filter' => [
                                'shingle'
                            ],
                            'type' => 'custom',
                            'tokenizer' => 'standard'
                        ]
                    ]
                ]
            ]
        ],

        'lifesituations' => [
            'providers' => [
                'eloquent' => KitSoft\Services\Classes\SearchLifeSituationsEloquentProvider::class,
                'elastic' => KitSoft\Services\Classes\SearchLifeSituationsElasticProvider::class,
            ],
            'model' => KitSoft\Services\Models\LifeSituation::class,
            'collection' => 'lifesituations',
            'searchableColumns' => ['title', 'content', 'excerpt'],
            'scopes' => ['isPublished'],
            'publicFields' => ['slug', 'id', 'parent_id'],
            'dynamicAttributes' => [
                'content' => 'sections_content'
            ],
            'mappings' => [
                '@timestamp' => ['type' => 'date'],
                'id' => ['type' => 'long'],
                'title' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'published' => ['type' => 'boolean'],
                'content' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'excerpt' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'slug' => ['type' => 'keyword', 'ignore_above' => 512],
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0,
                'analysis' => [
                    'filter' => [
                        'shingle' => [
                            'max_shingle_size' => 3,
                            'min_shingle_size' => 2,
                            'type' => 'shingle'
                        ]
                    ],
                    'analyzer' => [
                        'reverse' => [
                            'filter' => [
                                'reverse'
                            ],
                            'type' => 'custom',
                            'tokenizer' => 'standard'
                        ],
                        'trigram' => [
                            'filter' => [
                                'shingle'
                            ],
                            'type' => 'custom',
                            'tokenizer' => 'standard'
                        ]
                    ]
                ]
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
            'scopes' => ['isPublished', 'isNotSluggable', 'isSearchable'],
            'publicFields' => ['id', 'slug', 'parent_id', 'published_at'],
            'customUrl' => true,
            'mappings' => [
                '@timestamp' => ['type' => 'date'],
                'id' => ['type' => 'long'],
                'title' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'content' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'published' => ['type' => 'boolean'],
                'sluggable' => ['type' => 'boolean'],
                'searchable' => ['type' => 'boolean'],
                'url' => ['type' => 'keyword', 'ignore_above' => 1024],
                'slug' => ['type' => 'keyword', 'ignore_above' => 512],
                'tag_slugs' => ['type' => 'text', 'fields' => ['key' => [
                    'type' => 'keyword',
                    'ignore_above' => 256
                ]]]
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0,
                'analysis' => [
                    'filter' => [
                        'shingle' => [
                            'max_shingle_size' => 3,
                            'min_shingle_size' => 2,
                            'type' => 'shingle'
                        ]
                    ],
                    'analyzer' => [
                        'reverse' => [
                            'filter' => [
                                'reverse'
                            ],
                            'type' => 'custom',
                            'tokenizer' => 'standard'
                        ],
                        'trigram' => [
                            'filter' => [
                                'shingle'
                            ],
                            'type' => 'custom',
                            'tokenizer' => 'standard'
                        ]
                    ]
                ]
            ]
        ],

        'faq' => [
            'model' => KitSoft\Faq\Models\Question::class,
            'providers' => [
                'eloquent' => KitSoft\Faq\Providers\Eloquent\QuestionsProvider::class,
                'elastic' => KitSoft\Faq\Providers\Elastic\QuestionsProvider::class,
            ],
            'collection' => 'faq',
            'scopes' => ['isPublished'],
            'searchableColumns' => ['question', 'answer'],
            'publicFields' => ['id', 'published'],
            'orderBy' => ['created_at', 'desc'],
            'mappings' => [
                '@timestamp' => ['type' => 'date'],
                'id' => ['type' => 'long'],
                'question' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'answer' => [
                    'type' => 'text',
                    'term_vector' => 'with_positions_offsets',
                    'fields' => [
                        'reverse' => [
                            'type' => 'text',
                            'analyzer' => 'reverse'
                        ],
                        'standart' => [
                            'type' => 'text',
                            'term_vector' => 'with_positions_offsets'
                        ],
                        'trigram' => [
                            'type' => 'text',
                            'analyzer' => 'trigram'
                        ]
                    ],
                    'analyzer' => 'standard'
                ],
                'published' => ['type' => 'boolean'],
                'created_at' => ['type' => 'date']
            ],
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0,
                'analysis' => [
                    'filter' => [
                        'shingle' => [
                            'max_shingle_size' => 3,
                            'min_shingle_size' => 2,
                            'type' => 'shingle'
                        ]
                    ],
                    'analyzer' => [
                        'reverse' => [
                            'filter' => [
                                'reverse'
                            ],
                            'type' => 'custom',
                            'tokenizer' => 'standard'
                        ],
                        'trigram' => [
                            'filter' => [
                                'shingle'
                            ],
                            'type' => 'custom',
                            'tokenizer' => 'standard'
                        ]
                    ]
                ]
            ]
        ],
    ],

    'elastic_settings' => [
        // date fields to convert when put at elastic index
        // when send date with default format, elastic client failed with error
        'date_convert' => [
            'published_at',
            'creation_date',
            'updated_at',
            'created_at'
        ],
        'remove_html' => [
            'content_html',
            'html_content',
            'content',
            'excerpt',
            'description'
        ],
        'generate_url' => [
            'url' => 'fullUrl'
        ]
    ]
];