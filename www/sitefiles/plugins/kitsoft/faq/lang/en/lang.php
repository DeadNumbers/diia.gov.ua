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
            'questions_index' => 'Access questions',
            'categories_index' => 'Access categories',
            'inbox_show' => 'Show inbox in side menu',
        ],
    ],
    'side_menu' => [
        'inbox' => 'Inbox',
        'questions' => 'Questions',
        'categories' => 'Categories',
    ],
    'question' => [
        'tabs' => [
            'main' => 'Main',
        ],
        'fields' => [
            'question' => 'Question',
            'answer' => 'Answer',
            'link' => 'Link',
            'published' => 'Published',
            'answer_type' => 'Answer type',
            'answer_type_options' => [
                'answer' => 'Content',
                'link' => 'External link',
            ],
            'categories' => 'Categories',
        ],
        'columns' => [
            'id' => 'ID',
            'question' => 'Question',
            'published' => 'Published',
            'categories' => 'Categories',
            'created_at' => 'Created at',
        ],
    ],
    'category' => [
        'fields' => [
            'name' => 'Name',
            'slug' => 'Slug',
        ],
        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
        ],
    ],
    'buttons' => [
        'new_question' => 'New Question',
        'delete_selected' => 'Delete selected',
        'create' => 'Create',
        'create_and_close' => 'Create and Close',
        'cancel' => 'Cancel',
        'return_to_questions_list' => 'Return to questions list',
        'save' => 'Save',
        'save_and_close' => 'Save and Close',
        'return_to_categories_list' => 'Return to categories list',
        'new_category' => 'New Category',
        'reorder' => 'Reorder',
    ],
    'labels' => [
        'questions' => 'Questions',
        'question' => 'Question',
        'or' => 'or',
        'create_question' => 'Create Question',
        'edit_question' => 'Edit Question',
        'preview_question' => 'Preview Question',
        'manage_questions' => 'Manage Questions',
        'categories' => 'Categories',
        'reorder' => 'Reorder',
        'manage_categories' => 'Manage Categories',
        'category' => 'Category',
        'create_category' => 'Create Category',
        'edit_category' => 'Edit Category',
        'preview_category' => 'Preview Category',
    ],
    'alerts' => [
        'selected_questions_delete_confirm' => 'Are you sure you want to delete the selected Questions?',
        'item_question_delete_confirm' => 'Delete this question?',
        'selected_categories_delete_confirm' => 'Are you sure you want to delete the selected Categories?',
        'item_category_delete_confirm' => 'Delete this category?',
    ],
];