<?php namespace KitSoft\Polls\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Answer Types Back-end Controller
 */
class AnswerTypes extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController',
        '@KitSoft.MultiSite.Behaviors.MultiSiteController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Polls', 'polls', 'answertypes');
    }
}
