<?php namespace KitSoft\Pages\Controllers;

use Request;
use BackendMenu;
use Backend\Classes\Controller;

/**
 * Menu Items Back-end Controller
 */
class MenuItems extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = ['kitsoft.pages.menu.index'];

    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Pages', 'pages', 'menuitems');
    }

    /**
     * reorderExtendQuery
     */
    public function reorderExtendQuery($query) {
        if($menuId = Request::get('menu_id')) {
            $query->where('menu_id', $menuId);
        }
    }
}
