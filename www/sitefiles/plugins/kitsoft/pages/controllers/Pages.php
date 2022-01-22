<?php namespace KitSoft\Pages\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Config;
use Event;
use Flash;
use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Models\Page;
use System\Classes\PluginManager;
use View;

/**
 * Pages Back-end Controller
 */
class Pages extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController',
        'Backend.Behaviors.RelationController',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageController',
        '@KitSoft.MultiSite.Behaviors.MultiSiteController'
    ];

    public $formConfig     = 'config_form.yaml';
    public $listConfig     = 'config_list.yaml';
    public $reorderConfig  = 'config_reorder.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = ['kitsoft.pages.pages.index'];

    public $bodyClass = 'compact-container';

    public $deletable = true;

    /**
     * __construct
     */
    public function __construct()
    {
        Event::fire('kitsoft::controller.beforeConstruct', [$this]);

        parent::__construct();

        BackendMenu::setContext('KitSoft.Pages', 'pages', 'pages');

        $this->addCss('/plugins/kitsoft/pages/assets/css/pages.css');
    }

    /**
     * index
     */
    public function index() {
        parent::index();
        
        $this->vars['count'] = Page::isSystem(false)->count();
        $this->vars['systemCount'] = Page::isSystem()->count();
    }

    /**
     * formBeforeCreate
     */
    public function formBeforeCreate($model)
    {
        $model->user_id = $this->user->id;
    }

    /**
     * formExtendFields
     */
    public function formExtendFields($form, $fields)
    {
        $this->addComponentsAndSectionsFields($form, $fields);
        $this->addPermissionDeniedFields($form, $fields);

        Event::fire('kitsoft.pages::pages.controller.extendFormFields', [$form, $fields]);
    }

    /**
     * addComponentsAndSectionsFields
     */
    protected function addComponentsAndSectionsFields(&$form, &$fields)
    {
        if ($form->context == 'create') {
            $fields['layout']->value = Config::get('kitsoft.pages::defaultLayout');
        }

        if (PluginManager::instance()->hasPlugin('KitSoft.Search')) {
            $form->addSecondaryTabFields([
                'searchable' => [
                    'label' => 'kitsoft.pages::lang.page.fields.searchable',
                    'type'  => 'checkbox',
                    'default' => true
                ]
            ]);
        }
        
        if ($form->context !== 'update' || !$form->model->layout) {
            return;
        }

        if (!$cmsPage = PagesHelper::getPageSettings($form->model->layout)) {
            return;
        }
        
        $components = false;
        if (isset($cmsPage->attributes['components']) && $cmsPage->attributes['components']) {
            $components = true;
            $form->addTabFields([
                'components' => [
                    'label' => 'kitsoft.pages::lang.page.fields.components',
                    'type'  => 'partial',
                    'path'  => '$/kitsoft/pages/controllers/pages/_components.htm',
                    'tab'   => 'kitsoft.pages::lang.page.fields.components'
                ]
            ]);
        }

        $sections = false;
        if (isset($cmsPage->attributes['sections']) && $cmsPage->attributes['sections']) {
            $sections = true;
            $form->addTabFields([
                'sections' => [
                    'label' => 'kitsoft.pages::lang.page.fields.sections',
                    'type'  => 'partial',
                    'path'  => '$/kitsoft/pages/controllers/pages/_sections.htm',
                    'tab'   => 'kitsoft.pages::lang.page.fields.sections'
                ]
            ]);
        }

        /* if ($this->user->isSuperUser()) {
            $form->addTabFields([
                'layout_content' => [
                    'type' => 'codeeditor',
                    'size' => 'giant',
                    'language' => 'html',
                    'comment' => '* Can be changed only by developers',
                    'disabled' => 'true',
                    'tab' => 'kitsoft.pages::lang.page.fields.layout_content',
                ]
            ]);
        } */

        if (isset($cmsPage->attributes['hideContent']) && $cmsPage->attributes['hideContent']) {
            $form->removeField('content');
        }

        if (isset($cmsPage->attributes['deletable']) && !$cmsPage->attributes['deletable']) {
            $this->deletable = false;
        }
    }

    /**
     * addPermissionDeniedFields
     */
    protected function addPermissionDeniedFields(&$form, &$fields)
    {
        if (!$this->user->isSuperUser()) {
            return;
        }

        if (Config::get('kitsoft.pages::config.accessByDenied')) {
            $form->addTabFields([
                'denied_users' => [
                    'label'  => 'kitsoft.pages::lang.page.fields.denied_users',
                    'type'   => 'relation',
                    'tab'    => 'kitsoft.pages::lang.page.tabs.access',
                    'select' => "concat(login, ' (', first_name, ' ', last_name, ')')"
                ]
            ]);
        } else {
            $form->addTabFields([
                'granted_users' => [
                    'label'  => 'kitsoft.pages::lang.page.fields.granted_users',
                    'type'   => 'relation',
                    'tab'    => 'kitsoft.pages::lang.page.tabs.access',
                    'select' => "concat(login, ' (', first_name, ' ', last_name, ')')"
                ]
            ]);
        }
    }

    /**
     * extendQuery
     */
    public function formExtendQuery($query)
    {
        Event::fire('kitsoft::controller.formExtendQuery', [$query]);

        return $query->hasAccess($this->user);
    }

    /**
     * listExtendQuery
     */
    public function listExtendQuery($query)
    {
        if (request()->get('is_system')) {
            $query = $query->isSystem();
        } else {
            $query = $query->isSystem(false);
        }

        return $query->hasAccess($this->user);
    }

    /**
     * reorderExtendQuery
     */
    public function reorderExtendQuery($query)
    {
        return $query->isSystem(false);
    }

    /**
     * update_onDelete
     */
    public function update_onDelete($recordId = null)
    {
        // denied to delete system pages if not permission
        if (Page::isSystem()->find($recordId) && !$this->user->hasAccess('kitsoft.pages.pages.delete')) {
            Flash::error("Відсутній доступ до видалення системних сторінок.");
            return;
        }

        return parent::update_onDelete($recordId);
    }

    /**
     * index_onDelete
     */
    public function index_onDelete()
    {
        $checkedIds = post('checked');

        if (!$checkedIds || !is_array($checkedIds) || !count($checkedIds)) {
            return;
        }

        // denied to delete pages by layouts, deletable param in cmsPage
        foreach ($checkedIds as $id) {
            if (!$page = Page::find($id)) {
                continue;
            }
            if (!$page->layout) {
                continue;
            }
            $settings = PagesHelper::getPageSettings($page->layout);
            if (isset($settings->attributes['deletable']) && !$settings->attributes['deletable']) {
                Flash::error("Видалення сторінки '{$page->title}' заборонено.");
                return $this->listRefresh();
            }
        }

        // deniend to delete pages with childs
        if (!config('kitsoft.pages::enableTrash')) {
            foreach ($checkedIds as $id) {
                if (!Page::find($id)->getAllChildren()->count()) {
                    continue;
                }
                Flash::error('Спочатку треба видалити дочірні сторінки.');
                return $this->listRefresh();
            }
        }

        // denied to delete system pages if not permission
        foreach ($checkedIds as $id) {
            if (!$page = Page::isSystem()->find($id)) {
                continue;
            }
            if (!$this->user->hasAccess('kitsoft.pages.pages.delete')) {
                Flash::error("Відсутній доступ до видалення системних сторінок.");
                return $this->listRefresh();
            }
        }

        return parent::index_onDelete();
    }

    /**
     * onReorder
     */
    public function onReorder()
    {
        $position = post('position');
        $record_ids = post('record_ids');
        $source = Page::find(post('sourceNode'));
        $target = Page::find(post('targetNode'));

        switch ($position) {
            case 'before':
            case 'after':
                $pagesCount = Page::where('id', '<>', $source->id)
                    ->where('parent_id', $target->parent_id)
                    ->where('slug', $source->slug)
                    ->count();
                if ($pagesCount) {
                    Flash::error('Неможливо перемістити, сторінка з таким посиланням вже існує.');
                    return redirect()->to(url()->current());
                }
                break;
            case 'child':
                $pagesCount = Page::where('id', '<>', $source->id)
                    ->where('parent_id', $target->id)
                    ->where('slug', $source->slug)
                    ->count();
                if ($pagesCount) {
                    Flash::error('Неможливо перемістити, вже існує сторінка з таким посиланням.');
                    return redirect()->to(url()->current());
                }
                break;
            default:
                Flash::error('Unknown position.');
                return redirect()->to(url()->current());
                break;
        }
        
        try {
            $this->asExtension('Backend\Behaviors\ReorderController')->onReorder();
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return;
        }

        Flash::success('Збережено.');
    }
}
