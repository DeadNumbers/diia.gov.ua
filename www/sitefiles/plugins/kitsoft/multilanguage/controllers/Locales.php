<?php

namespace KitSoft\MultiLanguage\Controllers;

use Flash;
use Artisan;
use Redirect;
use BackendMenu;
use Backend\Classes\Controller;
use KitSoft\MultiLanguage\Models\Locale as LocaleModel;
use System\Classes\SettingsManager;

/**
 * Locales Back-end Controller
 */
class Locales extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['kitsoft.multilanguage.manage_locales'];

    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('KitSoft.MultiLanguage', 'locales');

        $this->addJs('/plugins/kitsoft/multilanguage/assets/js/locales.js');
    }

    /**
     * listInjectRowClass
     */
    public function listInjectRowClass($record, $definition = null)
    {
        if (!$record->is_enabled) {
            return 'safe disabled';
        }
    }

    /**
     * onCreateForm
     */
    public function onCreateForm()
    {
        $this->asExtension('FormController')->create();

        return $this->makePartial('create_form');
    }

    /**
     * onCreate
     */
    public function onCreate()
    {
        LocaleModel::clearCache();
        $this->asExtension('FormController')->create_onSave();

        return $this->listRefresh();
    }

    /**
     * onUpdateForm
     */
    public function onUpdateForm()
    {
        $this->asExtension('FormController')->update(post('record_id'));
        $this->vars['recordId'] = post('record_id');

        return $this->makePartial('update_form');
    }

    /**
     * onUpdate
     */
    public function onUpdate()
    {
        LocaleModel::clearCache();
        $this->asExtension('FormController')->update_onSave(post('record_id'));

        return $this->listRefresh();
    }

    /**
     * onDelete
     */
    public function onDelete()
    {
        LocaleModel::clearCache();
        $this->asExtension('FormController')->update_onDelete(post('record_id'));

        return $this->listRefresh();
    }

    /**
     * onMakeEntities
     */
    public function onMakeEntities()
    {
        Artisan::call('multilanguage:makeentities');
        Flash::success(trans('kitsoft.multilanguage::lang.messages.make_entities_success'));

        return Redirect::back();
    }
}
