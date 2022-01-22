<?php

return [
    'posts' => [
        'top'     => 'Top',
        'fixed'   => 'Fixed',
        'regular' => 'Regular',
        'hits'    => 'Views',
    ],
    'category' => [
        'favourite' => 'Favourite',
    ],
    'post' => [
        'author'            => 'Author',
        'is_author_visible' => 'Show author name',
        'authors'           => 'Authors',
        'preview'           => 'Preview',
        'seo'               => [
            'meta_title'       => 'Meta Title',
            'meta_h1'          => 'Meta H1',
            'meta_description' => 'Meta Description',
            'meta_keywords'    => 'Meta Keywords',
            'og_image'         => 'Open Graph Image',
        ],
    ],
    'components' => [
        'lastnews' => [
            'name'        => 'Last news | filter',
            'description' => 'A component of displaying the latest filterable news',
            'groups' => [
                'main'       => 'Main',
                'filters'    => 'Filters',
                'all_news'   => 'All news',
                'categories' => 'Categories',
            ],
            'fields' => [
                'count'    => 'Count',
                'is_top'   => 'Filter By Top',
                'is_fixed' => 'Filter by Fixed',
                'posts_label'    => 'Posts label',
                'exclude_top'    => 'Exclude Top',
                'button_link'    => 'Link to all news',
                'is_top_order'   => 'Order By Top Param',
                'exclude_slug'   => 'Exclude Current Slug',
                'exclude_fixed'  => 'Exclude Fixed',
                'is_fixed_order' => 'Order By Fixed Param',
                'posts_categories_filter' => 'Include to displaying this news categories',
                'posts_categories_filter_comment' => '(leave blank to select all)'
            ],
        ],
        'categories' => [
            'name'        => 'News by Category',
            'description' => 'Generates news output according by selected categories',
            'tabs' => [
                'main'   => 'Main',
                'filter' => 'Filter',
            ],
            'fields' => [
                'count'          => 'Count',
                'posts_label'    => 'Label',
                'add_fixed_news' => 'Fixed news',
                'post_categories_filter'     => 'Add the following news categories to display',
                'add_fixed_news_description' => 'Pinned news will be displayed at the top of the category news list',
            ],
        ],
        'posts' => [
            'name'        => 'Posts',
            'description' => 'The component of displaying the news directory according to the settings and get-parameters obtained',
            'tabs' => [
                'main' => 'Main',
            ],
            'fields' => [
                'count'          => 'Count',
                'posts_label'    => 'Label',
                'is_top_order'   => 'Order By Top Param',
                'is_fixed_order' => 'Order By Fixed Param',
            ],
        ],
        'post' => [
            'name'        => 'Post',
            'description' => 'The component of displaying the current news',
            'tabs' => [
                'related_news' => 'Related news',
            ],
            'fields' => [
                'load_related'  => 'Load related news',
                'related_type'  => 'Filter',
                'related_count' => 'Count of related news',
                'related_type_options' => [
                    'tag'  => 'by first tag',
                    'tags' => 'by tags',
                    'category'   => 'by first category',
                    'categories' => 'by categories',
                ],
            ],
        ],
        'main_news' => [
            'name'        => 'Main News | News of favourite categories',
            'description' => 'Load news by favourite categories with tags',
            'tabs' => [
                'main' => 'Main',
            ],
            'fields' => [
                'posts_count'      => 'Posts count',
                'categories_count' => 'Categories count',
            ],
        ],
        'category' => [
            'name'        => 'Category',
            'description' => 'Displays news in the current category',
        ],
        'popular_news' => [
            'name'        => 'Popular news',
            'description' => 'Displays the most viewed news',
            'tabs' => [
                'main' => 'Main',
            ],
            'fields' => [
                'count' => 'Count',
            ],
        ],
        'external_news' => [
            'name'        => 'External news (API)',
            'description' => 'Get news from an external API',
            'tabs' => [
                'main'   => 'Main',
                'button' => 'Button',
            ],
            'fields' => [
                'posts'   => 'Posts label',
                'count'   => 'Count',
                'api_url' => 'API Address',
                'target'  => 'Open in a new window',
                'button_url'   => 'Button link',
                'button_label' => 'Button label',
            ],
        ],
    ],
    'tab' => [
        'seo' => 'SEO',
    ],
    'rlblogxt' => [
        'menu_label'      => 'Author',
        'create_author'   => 'Author',
        'access_authors'  => 'Access Authors',
        'manage_settings' => 'Manage Settings',
    ],
    'author' => [
        'name'             => 'Name',
        'posts'            => 'Posts',
        'name_placeholder' => '',
        'slug'             => 'URL',
        'slug_placeholder' => '',
        'description'      => 'Description',
        'uri'              => 'Link',
    ],
    'authors' => [
        'new_author' => 'New Author',
        'list_title' => 'List',
        'labels'     => [
            'menu_label' => 'Authors',
        ],
        'successfully_deleted' => 'Successfully deleted',
    ],
];