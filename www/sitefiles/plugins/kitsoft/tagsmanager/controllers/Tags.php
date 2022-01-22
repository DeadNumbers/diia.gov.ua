<?php namespace KitSoft\TagsManager\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use KitSoft\TagsManager\Models\Tag;

/**
 * Tags Back-end Controller
 */
class Tags extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['kitsoft.tagsmanager.access_tags'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.TagsManager', 'Manager', 'Tags');
    }

    /**
     * onGenerateSlugs
     */
    public function onGenerateSlugs() {
        Tag::whereNull('slug')->orderBy('id')->chunk(100, function ($items) {
            foreach ($items as $item) {
                $item->slug = str_slug($item->name);
                $item->save();
            }
        });
    }
}
