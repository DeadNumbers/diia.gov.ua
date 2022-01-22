<?php namespace KitSoft\Pages\Controllers;

use View;
use BackendMenu;
use Backend\Classes\Controller;
use Db;
use Request;

/**
 * Components Back-end Controller
 */
class Components extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Pages', 'pages', 'components');
    }

    /**
     * index
     */
    public function index()
    {
        if(!$this->user->isSuperUser()) {
            return View::make('backend::access_denied');
        }
        $this->asExtension('ListController')->index();
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

    /**
     * reorderExtendQuery
     */
    public function reorderExtendQuery($query) {
        if($relationId = Request::get('relation_id')) {
            $componentsIds = Db::table('kitsoft_pages_entities')
                ->where('page_id', $relationId)
                ->where('entity_type', 'KitSoft\Pages\Models\Component')
                ->lists('entity_id');

            $query->whereIn('id', $componentsIds);
        }
    }
}
