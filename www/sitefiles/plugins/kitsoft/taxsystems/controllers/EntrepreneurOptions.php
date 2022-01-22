<?php namespace KitSoft\TaxSystems\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Request;

/**
 * Entrepreneur Options Back-end Controller
 */
class EntrepreneurOptions extends Controller
{
    public $implement = [
        'Backend.Behaviors.ReorderController'
    ];

    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.TaxSystems', 'taxsystems', 'entrepreneurquestions');
    }

    /**
     * formBeforeCreate
     */
    public function formBeforeCreate($model)
    {
        $model->user_id = $this->user->id;
    }

    /**
     * reorderExtendQuery
     */
    public function reorderExtendQuery($query)
    {
        if ($entrepreneurQuestionId = Request::get('entrepreneur_question_id')) {
            $query->where('entrepreneur_question_id', (int)$entrepreneurQuestionId);
        }
    }
}
