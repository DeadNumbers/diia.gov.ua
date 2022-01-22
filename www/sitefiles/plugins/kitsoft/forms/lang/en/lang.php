<?php return [
    'plugin' => [
        'name'        => 'Forms',
        'description' => '',
    ],

    'field' => [
        'tabs' => [

        ],
        'fields' => [
            'id'      => 'ID',
            'title'   => 'Title',
            'type'    => 'Type',
            'code'    => 'Code',
            'rules'   => 'Rules',
            'options' => 'Options',
            'options_prompt' => 'Add element',
            'rules_options'  => [
                'required'   => 'Required',
                'numeric'    => 'Numeric',
                'email'      => 'Email',
                'recaptcha'  => 'Recaptcha',
                'image'      => 'Image',
                'limit'      => 'Length limit',
                'min'        => 'Minimum number of characters',
                'max'        => 'Maximum number of characters',
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
                'title' => 'Title',
                'value' => 'Value',
            ],
            'placeholder'     => 'Placeholder',
            'file_extensions' => 'Mimes file types',
            'file_extensions_comment' => 'Enter the allowed comma types<br>jpg,jpeg,zip,rar,etc.',
        ],
    ],

    'form' => [
        'tabs' => [
            'main'      => 'Main',
            'send_mail' => 'Send to mail',
            'fields'    => 'Fields',
        ],
        'fields' => [
            'id'     => 'ID',
            'name'   => 'Name',
            'code'   => 'Code',
            'send'   => 'Send to mail',
            'fields' => 'Fields',
            'emails' => 'Emails',
            'emails_prompt' => 'Add emails',
            'emails_form'   => [
                'email' => 'Email'
            ],
            'template'      => 'Template',
            'description'   => 'Description',
            'success_text'  => 'Successful submission text',
            'submit_text'   => 'Text on submit button',
            'template_comment' => 'An example application in a mail template - {{ fields.name }}.',
        ],
    ],

    'inbox' => [
        'tabs' => [

        ],
        'fields' => [
            'id' => 'ID',
            'ip' => 'IP Address',
            'form'   => 'Form',
            'files'  => 'Files',
            'fields' => 'Fields',
            'date_to'      => 'Date to',
            'date_from'    => 'Date from',
            'created_at'   => 'Created at',
            'status_label' => 'Status',
        ],
        'statuses' => [
            'new'     => 'New',
            'process' => 'In process',
            'closed'  => 'Closed',
        ],
        'filters' => [
            'form'   => 'Forms',
            'status' => 'Status',
        ],
    ],

    'settings' => [

    ],

    'permissions' => [
        'tabs' => [
            'forms' => 'Forms'
        ],
        'permissions' => [
            'manage_forms'    => 'Manage forms',
            'manage_inbox'    => 'Manage inbox',
            'access_settings' => 'Access to settings',
        ],
    ],

    'settings_menu' => [
        'tabs' => [
            'forms' => 'Forms',
        ],
        'menu' => [
            'inbox'    => 'Inbox',
            'forms'    => 'Forms',
            'settings' => 'Settings',
        ],
    ],

    'system' => [
        'buttons' => [
            'save' => 'Save',
            'back' => 'Back',
            'new_field' => 'New Field',
            'new_form'  => 'New Form',
            'add_field' => 'Add Field',
            'reorder'   => 'Reorder',
            'delete'    => 'Delete',
            'create'    => 'Create',
            'cancel'    => 'Cancel',
            'download'  => 'Download',
            'export'    => 'Export',
            'delete_selected'  => 'Delete selected',
            'back_to_form'     => 'Back to Form',
            'create_and_close' => 'Create and Close',
            'save_and_close'   => 'Save and Close',
            'change_status'    => 'Change status',
            'return_to_fields_list' => 'Return to fields list',
            'return_to_forms_list'  => 'Return to forms list',
            '' => '',
        ],
        'labels' => [
            'or' => 'or',
            'field'   => 'Field',
            'fields'  => 'Fields',
            'form'    => 'Form',
            'forms'   => 'Forms',
            'inbox'   => 'Inbox',
            'inboxes' => 'Inboxes',
            'create_field'   => 'Create Field',
            'create_form'    => 'Create Form',
            'edit_field'     => 'Edit Field',
            'edit_form'      => 'Edit Form',
            'preview_field'  => 'Preview Field',
            'preview_form'   => 'Preview Form',
            'preview_inbox'  => 'Preview Inbox',
            'manage_fields'  => 'Manage Fields',
            'manage_forms'   => 'Manage Forms',
            'manage_inboxes' => 'Manage Inboxes',
            'reorder_fields' => 'Reorder Fields',
            'save_form_before_use'        => 'Please Save Form before use fields',
            'download_inboxes_for_period' => 'You can download inboxes for the selected period',
            '' => '',
        ],
        'alerts' => [
            'confirm_delete_fields'  => 'Are you sure you want to delete the selected Fields?',
            'confirm_delete_forms'   => 'Are you sure you want to delete the selected Forms?',
            'confirm_delete_inboxes' => 'Are you sure you want to delete the selected Inboxes?',
            'confirm_change_status'  => 'Change to status',
        ],
    ],

    'components' => [
        'form' => [
            'name'        => 'Forms',
            'description' => 'A component displaying a form by its code',
            'tabs' => [],
            'fields' => [
                'code' => 'Form code'
            ],
        ]
    ],

    'widgets' => [
        'unreaded_inboxes' => [
            'name' => 'Unread Inbox',
            'statuses' => [
                'new_inboxes'    => 'New inbox',
                'no_new_inboxes' => 'No new inbox',
            ],
        ],
    ],
];