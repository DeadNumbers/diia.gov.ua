<?php namespace KitSoft\RLBlogXT\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use KitSoft\RLBlogXT\Models\Author;
use Flash;

class Authors extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = ['kitsoft.rlblogxt.access_authors'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('RainLab.Blog', 'blog', 'authors');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $authorId) {
                if ((!$author = Author::find($authorId)))
                    continue;

                $author->delete();
            }

            Flash::success(e(trans('kitsoft.rlblogxt::lang.authors.successfully_deleted')));
        }

        return $this->listRefresh();
    }
}