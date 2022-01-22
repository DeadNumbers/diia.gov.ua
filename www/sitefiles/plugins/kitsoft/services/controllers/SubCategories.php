<?php namespace KitSoft\Services\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Sub Categories Back-end Controller
 */
class SubCategories extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['kitsoft.services.subcategories'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Services', 'services', 'subcategories');
    }

    /**
     * update
     */
    public function update($id, $context = null)
    {
        $this->addJs('/modules/backend/behaviors/reordercontroller/assets/js/october.reorder.js', 'core');

        return parent::update($id, $context);
    }

    /**
     * onReorder
     */
    public function onReorder($id)
    {
        if ($record_ids = request()->get('reorder_services_ids')) {
            $model = $this->formFindModelObject($id);

            foreach ($record_ids as $sort_order => $record_id) {
                $model->services()->updateExistingPivot($record_id, ['sort_order' => $sort_order + 1]);
            }

            return;
        }

        $this->asExtension('ReorderController')->onReorder();
    }
}
