<?php namespace KitSoft\Polls\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Questions Back-end Controller
 */
class Questions extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController',
        '@KitSoft.MultiSite.Behaviors.MultiSiteController'
    ];

    public $requiredPermissions = ['kitsoft.polls.questions.index'];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Polls', 'polls', 'questions');
    }
}
