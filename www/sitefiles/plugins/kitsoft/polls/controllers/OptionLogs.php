<?php namespace KitSoft\Polls\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Option Logs Back-end Controller
 */
class OptionLogs extends Controller
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

        BackendMenu::setContext('KitSoft.Polls', 'polls', 'optionlogs');
    }
}
