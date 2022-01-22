<?php namespace KitSoft\Polls\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Answers Back-end Controller
 */
class Answers extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController',
        '@KitSoft.MultiSite.Behaviors.MultiSiteController'
    ];

    public $requiredPermissions = ['kitsoft.polls.answers.index'];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Polls', 'polls', 'answers');
    }
}
