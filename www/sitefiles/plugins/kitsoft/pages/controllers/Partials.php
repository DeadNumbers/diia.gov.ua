<?php namespace KitSoft\Pages\Controllers;

use App;
use View;
use BackendMenu;
use Backend\Classes\Controller;

/**
 * Partials Back-end Controller
 */
class Partials extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $bodyClass = 'compact-container';

    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Pages', 'pages', 'partials');
    }

    /**
     * create
     */
    public function create()
    {
        if(!$this->user->isSuperUser()) {
            return View::make('backend::access_denied');
        }
        return $this->asExtension('FormController')->create();
    }
}
