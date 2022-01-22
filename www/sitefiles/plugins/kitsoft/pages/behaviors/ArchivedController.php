<?php namespace KitSoft\Pages\Behaviors;

use ApplicationException;
use Db;
use Event;
use Config;
use Exception;
use October\Rain\Database\NestedTreeScope;
use October\Rain\Extension\ExtensionBase;
use Request;

/**
 * Base class for model behaviors.
 */
class ArchivedController extends ExtensionBase
{
    use \System\Traits\ViewMaker;

    public $isArchive;

    protected $controller;
    protected $modelClass;

    /**
     * Constructor
     */
    public function __construct($controller)
    {
        $this->isArchive = request()->has('archived');

        $this->controller = $controller;

        $this->modelClass = $this->controller
            ->asExtension('Backend.Behaviors.FormController')
            ->getConfig()
            ->modelClass;

        if ($this->isArchive) {
            $this->controller->addCss('/plugins/kitsoft/pages/assets/css/archive.css');
        }

        // extend query
        Event::listen('backend.list.extendQuery', function ($controller, $query) {
            if ($this->modelClass == get_class($query->getModel())) {
                $this->listExtendQuery($query);
            }
        });

        // sidebar
        Event::listen('kitsoft.pages.archive.sidebar', function () {
            echo $this->renderToolbarSidebar();
        });

        // toolbar
        Event::listen('kitsoft.pages.archive.toolbar', function () {
            echo $this->renderToolbarButtons();
        });

        // add form fields
        Event::listen('backend.form.extendFieldsBefore', function ($controller) {
            if(Request::ajax() || !$controller->model->archived_at || $controller->alias !== 'form') {
                return;
            }

            $controller->fields = array_prepend($controller->fields, [
                'type' => 'partial',
                'path' => '$/kitsoft/pages/behaviors/archivedcontroller/_notification.htm'
            ], 'archivedNotification');

            $controller->secondaryTabs['fields'][] = [
                'type' => 'partial',
                'path' => '$/kitsoft/pages/behaviors/archivedcontroller/_buttons.htm'
            ];
        });

        // remove global scope from form
        Event::listen('kitsoft::controller.formExtendQuery', function ($query) {
            $query->withArchived();
        });

        // extend records
        if ($this->modelClass::make()->hasGlobalScope(new NestedTreeScope)) {
            Event::listen('backend.list.extendRecords', function ($controller, &$records) {
                $records = $this->listExtendRecords($records);
            });
        }
    }

    /**
     * onArchive
     */
    public function onArchive(int $recordId) {
        if ($object = $this->modelClass::find($recordId)) {
            $object->archivate();
        }

        return $this->controller->listRefresh();
    }

    /**
     * onListArchive
     */
    public function onListArchive() {
        $checkedIds = request()->post('checked');

        Db::beginTransaction();
        try {
            foreach ($checkedIds as $id) {
                $this->onArchive($id);
            }
        } catch (Exception $e) {
            Db::rollback();
            throw new ApplicationException($e->getMessage());
        }

        Db::commit();

        return $this->controller->listRefresh();
    }

    /**
     * onUnarchive
     */
    public function onUnarchive(int $recordId) {
        $this->getValidObjectForUnarchive($recordId)->unarchivate();

        return $this->controller->listRefresh();
    }

    /**
     * onListUnarchive
     */
    public function onListUnarchive() {
        $checkedIds = request()->post('checked');

        Db::beginTransaction();
        try {
            foreach ($checkedIds as $id) {
                $this->onUnarchive($id);
            }
        } catch (Exception $e) {
            Db::rollback();
            throw new ApplicationException($e->getMessage());
        }

        Db::commit();

        return $this->controller->listRefresh();
    }

    /**
     * renderToolbarSidebar
     */
    protected function renderToolbarSidebar() {
        $model = $this->controller->widget->list->model;

        return $this->makePartial('sidebar', [
            'active' => request()->has('archived'),
            'url' => request()->url() . '?archived',
            'count' => $model::onlyArchived()->count()
        ]);
    }

    /**
     * renderToolbarButtons
     */
    protected function renderToolbarButtons()
    {
        return $this->makePartial('toolbar');
    }

    /**
     * listExtendQuery
     */
    protected function listExtendQuery($query)
    {
        if ($this->isArchive) {
            $query->onlyArchived();
        } else {
            $query->withoutArchived();
        }
    }

    protected function listExtendRecords($records)
    {
        if (!$this->isArchive) {
            return $records;
        }

        $items = $this->modelClass::onlyArchived()->get()
            ->filter(function ($item) {
                return $item->isRoot() ?: $item->getParent()->count();
            })
            ->sortByDesc('archived_at');

        return $this->setChildrenRelations($items);
    }

    /**
     * setChildrenRelations recursive
     */
    protected function setChildrenRelations($items)
    {
        return $items->each(function ($item) {
            $childs = $item::withoutGlobalScope('withoutArchived')
                ->where('parent_id', $item->id)
                ->get();

            if (!$childs->count()) {
                $item->nest_left = 1;
                $item->nest_right = 2;
                return;
            }

            $item->setRelation('children', $childs);
            $item->children = $this->setChildrenRelations($item->children);
        });
    }

    /**
     * getValidObjectForUnarchive
     */
    protected function getValidObjectForUnarchive($id) {
        $object = $this->modelClass::withoutGlobalScope('withoutArchived')
            ->find($id);

        if ($this->modelClass::make()->hasGlobalScope(new NestedTreeScope)) {
            if ($object->parent_id && !$object->parent) {
                throw new ApplicationException("Не можліво відновити, у сторінки [{$object->title}] не існує батьківської.");
            }
        }

        return $object;
    }
}
