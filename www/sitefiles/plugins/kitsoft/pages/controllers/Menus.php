<?php namespace KitSoft\Pages\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Menus Back-end Controller
 */
class Menus extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController',
        'Backend.Behaviors.RelationController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = ['kitsoft.pages.menu.index'];

    public $bodyClass = 'compact-container';

    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Pages', 'pages', 'menus');
    }
}
