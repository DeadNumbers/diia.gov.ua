<?php namespace KitSoft\Digest\Controllers;

use Event;
use BackendMenu;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;

/**
 * Lists Sync Back-end Controller
 */
class ListsSync extends Controller
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

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('KitSoft.Digest', 'listssync');
    }

    /**
     * formExtendFields
     */
    public function formExtendFields($form, $fields)
    {
        if ($form->model->system) {
            $fields['code']->disabled = true;
            $form->addTabFields(['system' => [
                'label' => 'Is System',
                'span' => 'auto',
                'type' => 'checkbox',
                'disabled' => true
            ]]);
        }

        Event::fire('kitsoft.digest::listssync.extendForm', [&$form, &$fields]);
    }

    /**
     * onExportLists
     */
    public function onExportLists()
    {
        Event::fire('kitsoft.digest::listssync.exportLists');
    }
}
