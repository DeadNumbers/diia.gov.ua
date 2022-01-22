<?php namespace KitSoft\Services\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Life Situations Back-end Controller
 */
class LifeSituations extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
        'Backend.Behaviors.ReorderController',
        '@KitSoft.MultiSite.Behaviors.MultiSiteController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = ['kitsoft.services.lifesituations'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Services', 'services', 'lifesituations');
    }

    /**
     * formExtendFields
     */
    public function formExtendFields($form, $fields)
    {
        if (!$form->model->parent_id) {
            $form->removeField('sections');
            $form->removeField('content');
        }
    }
}
