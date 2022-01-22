<?php namespace KitSoft\Faq;

use App;
use Backend;
use KitSoft\Forms\Models\Inbox;
use System\Classes\PluginBase;

/**
 * Faq Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'KitSoft.MultiLanguage',
        'KitSoft.Forms'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'kitsoft.faq::lang.plugin.name',
            'description' => 'kitsoft.faq::lang.plugin.description',
            'author'      => 'KitSoft',
            'icon'        => 'icon-question-circle-o'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        App::make('KitSoft\Faq\Extensions\FormExtension');
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'KitSoft\Faq\Components\Question' => 'faqQuestion',
            'KitSoft\Faq\Components\Questions' => 'faqQuestions',
            'KitSoft\Faq\Components\Categories' => 'faqCategories',
            'KitSoft\Faq\Components\Category' => 'faqCategory'
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'kitsoft.faq.questions.index' => [
                'tab' => 'kitsoft.faq::lang.permissions.tabs.faq',
                'label' => 'kitsoft.faq::lang.permissions.fields.questions_index'
            ],
            'kitsoft.faq.categories.index' => [
                'tab' => 'kitsoft.faq::lang.permissions.tabs.faq',
                'label' => 'kitsoft.faq::lang.permissions.fields.categories_index'
            ],
            'kitsoft.faq.inbox.show' => [
                'tab' => 'kitsoft.faq::lang.permissions.tabs.faq',
                'label' => 'kitsoft.faq::lang.permissions.fields.inbox_show'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'faq' => [
                'label'       => 'kitsoft.faq::lang.plugin.name',
                'url'         => Backend::url('kitsoft/faq/questions'),
                'icon'        => 'icon-question-circle-o',
                'permissions' => ['kitsoft.faq.*'],
                'order'       => 500,

                'sideMenu' => [
                    'inbox' => [
                        'label'       => 'kitsoft.faq::lang.side_menu.inbox',
                        'icon'        => 'icon-envelope',
                        'url'         => Backend::url('kitsoft/forms/inboxes?form=faq'),
                        'counter'     => Inbox::getUnreadedInboxCount('faq'),
                        'permissions' => ['kitsoft.faq.inbox.show']
                    ],

                    'questions' => [
                        'label'       => 'kitsoft.faq::lang.side_menu.questions',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('kitsoft/faq/questions'),
                        'permissions' => ['kitsoft.faq.questions.index']
                    ],

                    'categories' => [
                        'label'       => 'kitsoft.faq::lang.side_menu.categories',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('kitsoft/faq/categories'),
                        'permissions' => ['kitsoft.faq.categories.index']
                    ],
                ]
            ],
        ];
    }
}
