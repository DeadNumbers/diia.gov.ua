<?php namespace KitSoft\MultiLanguage\Controllers;

use Lang;
use Flash;
use Artisan;
use Redirect;
use BackendMenu;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
use KitSoft\MultiLanguage\Models\Locale;
use KitSoft\MultiLanguage\Classes\ThemeScanner;

/**
 * Messages Back-end Controller
 */
class Messages extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['kitsoft.multilanguage.manage_messages'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('KitSoft.MultiLanguage', 'messages');

        $this->addJs('/plugins/kitsoft/multilanguage/assets/js/messages.js');
    }

    public function formExtendFields($form)
    {
        if ($form->context == 'create') {
            return;
        }

        $langs = Locale::listAvailable();
        
        foreach ($langs as $code => $name) {
            $form->addFields([
                "translates[{$code}]" => [
                    'label' => $name,
                    'type' => 'textarea',
                    'size' => 'medium'
                ]
            ]);
        }
    }

    public function onCreateForm()
    {
        $this->asExtension('FormController')->create();

        return $this->makePartial('create_form');
    }

    public function onCreate()
    {
        $this->asExtension('FormController')->create_onSave();

        return $this->listRefresh();
    }

    public function onUpdateForm()
    {
        $this->asExtension('FormController')->update(post('record_id'));
        $this->vars['recordId'] = post('record_id');

        return $this->makePartial('update_form');
    }

    public function onUpdate()
    {
        $this->asExtension('FormController')->update_onSave(post('record_id'));

        return $this->listRefresh();
    }

    public function onDelete()
    {
        $this->asExtension('FormController')->update_onDelete(post('record_id'));

        return $this->listRefresh();
    }

    public function onScanMessages()
    {
        ThemeScanner::scan();

        Flash::success(Lang::get('kitsoft.multilanguage::messages.scan_messages_success'));

        return Redirect::back();
    }

    /**
     * onImportFromRainLabTranslate
     */
    public function onImportFromRainLabTranslate()
    {
        Artisan::call('multilanguage:importmessages');
        Flash::success(Lang::get('kitsoft.multilanguage::messages.scan_messages_success'));

        return Redirect::back();
    }
}
