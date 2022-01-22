<?php namespace KitSoft\Revisions\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use KitSoft\Revisions\Classes\Helpers;
use KitSoft\Revisions\Models\Revision;
use System\Classes\SettingsManager;
use ValidationException;
use Validator;

/**
 * Revisions Back-end Controller
 */
class Revisions extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'revisions');
        SettingsManager::setContext('KitSoft.Revisions', 'revisions');

        $this->addJs('/plugins/kitsoft/revisions/assets/js/revisions.js');
        $this->addCss('/plugins/kitsoft/revisions/assets/css/revisions.css');
    }
}