<?php namespace KitSoft\Pages\Controllers;

use Db;
use View;
use Request;
use BackendMenu;
use Backend\Classes\Controller;

/**
 * Sections Back-end Controller
 */
class Sections extends Controller
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

        BackendMenu::setContext('KitSoft.Pages', 'pages', 'sections');
    }

    /**
     * index
     */
    public function index()
    {
        if (!$this->user->isSuperUser()) {
            return View::make('backend::access_denied');
        }
        $this->asExtension('ListController')->index();
    }

    /**
     * create
     */
    public function create()
    {
        if (!$this->user->isSuperUser()) {
            return View::make('backend::access_denied');
        }
        return $this->asExtension('FormController')->create();
    }

    /**
     * reorderExtendQuery
     */
    public function reorderExtendQuery($query)
    {
        $table = Request::get('table') ?? 'kitsoft_pages_entities';
        $type = Request::get('type_id') ?? 'page_id';

        if ($relationId = Request::get('relation_id')) {
            $sectionsIds = Db::table($table)
                ->where($type, $relationId)
                ->where('entity_type', 'KitSoft\Pages\Models\Section')
                ->lists('entity_id');

            $query->whereIn('id', $sectionsIds);
        }
    }
}
