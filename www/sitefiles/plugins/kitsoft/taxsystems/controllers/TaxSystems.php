<?php namespace KitSoft\TaxSystems\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Tax Systems Back-end Controller
 */
class TaxSystems extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController',
        'Backend.Behaviors.RelationController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController',
        '@KitSoft.MultiSite.Behaviors.MultiSiteController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $bodyClass = 'compact-container';

    public $requiredPermissions = ['kitsoft.taxsystems.taxsystems.index'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.TaxSystems', 'taxsystems', 'taxsystems');
    }

    /**
     * formBeforeCreate
     */
    public function formBeforeCreate($model)
    {
        $model->user_id = $this->user->id;
    }
}
