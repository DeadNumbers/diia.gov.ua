<?php namespace KitSoft\Services\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Services Back-end Controller
 */
class Services extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
        'Backend.Behaviors.ImportExportController',
        '@KitSoft.MultiSite.Behaviors.MultiSiteController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public $requiredPermissions = ['kitsoft.services.services'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Services', 'services', 'services');
    }
}
