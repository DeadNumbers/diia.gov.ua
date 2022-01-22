<?php namespace KitSoft\Services\Controllers;

use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use Exception;

/**
 * Categories Back-end Controller
 */
class Categories extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['kitsoft.services.categories'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('KitSoft.Services', 'services', 'categories');
    }

    /**
     * update
     */
    public function update($id)
    {
        $this->addJs('/modules/backend/behaviors/reordercontroller/assets/js/october.reorder.js', 'core');

        return parent::update($id);
    }

    /**
     * onReorder
     */
    public function onReorder(int $id)
    {
        $model = $this->formFindModelObject($id);

        $sourceNode = request()->get('sourceNode');
        $targetNode = request()->get('targetNode');
        $position = request()->get('position');
        $record_ids = request()->get('reorder_subcategories_ids');

        try {
            // set sort_order pivot for all subcategories
            foreach ($record_ids as $sort_order => $record_id) {
                $model->subcategories()->updateExistingPivot($record_id, [
                    'sort_order' => $sort_order + 1
                ]);
            }

            // set parent_id pivot for source subcategory
            switch ($position) {
                case 'child':
                    $model->subcategories()->updateExistingPivot($sourceNode, [
                        'parent_id' => $targetNode
                    ]);
                    break;
                case 'after':
                case 'before':
                    $target = $model->subcategories()
                        ->withPivot('parent_id')
                        ->wherePivot('subcategory_id', $targetNode)
                        ->first();

                    $model->subcategories()->updateExistingPivot($sourceNode, [
                        'parent_id' => $target->pivot->parent_id ?? null
                    ]);
                    break;
            }
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return;
        }

        Flash::success('Сортування збережено');
    }
}
