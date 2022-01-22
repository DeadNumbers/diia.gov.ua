<?php namespace KitSoft\Polls\Controllers;

use Db;
use Request;
use BackendMenu;
use Backend\Classes\Controller;

/**
 * Options Back-end Controller
 */
class Options extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Polls', 'polls', 'options');
    }

    /**
     * reorderExtendQuery
     */
    public function reorderExtendQuery($query) {
        if ($questionId = Request::get('question_id')) {
            $optionsIds = Db::table('kitsoft_polls_questions_options')
                ->where('question_id', $questionId)
                ->lists('option_id');

            $query->whereIn('id', $optionsIds);
        }
    }
}
