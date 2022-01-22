<?php namespace KitSoft\Pages\Behaviors;

use ApplicationException;
use Db;
use Event;
use Config;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use October\Rain\Database\NestedTreeScope;
use October\Rain\Extension\ExtensionBase;
use Request;

/**
 * Base class for model behaviors.
 */
class TrashedController extends ExtensionBase
{
    use \System\Traits\ViewMaker;

    public $isTrash;

    protected $controller;
    protected $modelClass;

    /**
     * Constructor
     */
    public function __construct($controller)
    {
        $this->isTrash = request()->has('trashed');

        $this->controller = $controller;

        $this->modelClass = $this->controller
            ->asExtension('Backend.Behaviors.FormController')
            ->getConfig()
            ->modelClass;

        if ($this->isTrash) {
            $this->controller->addCss('/plugins/kitsoft/pages/assets/css/trash.css');
        }
        
        // extend query
        Event::listen('backend.list.extendQuery', function ($controller, $query) {
            if ($this->modelClass == get_class($query->getModel())) {
                $this->listExtendQuery($query);
            }
        });

        // sidebar
        Event::listen('kitsoft.pages.trash.sidebar', function () {
            echo $this->renderToolbarSidebar();
        });

        // toolbar
        Event::listen('kitsoft.pages.trash.toolbar', function () {
            echo $this->renderToolbarButtons();
        });

        // add form fields
        Event::listen('backend.form.extendFieldsBefore', function ($controller) {
            if (Request::ajax() || !$controller->model->deleted_at || $controller->alias !== 'form') {
                return;
            }
            $controller->fields = array_prepend($controller->fields, [
                'type' => 'partial',
                'path' => '$/kitsoft/pages/behaviors/trashedcontroller/_notification.htm'
            ], 'trashedNotification');

            $controller->secondaryTabs['fields'][] = [
                'type' => 'partial',
                'path' => '$/kitsoft/pages/behaviors/trashedcontroller/_buttons.htm'
            ];
        });

        // remove global scope from form
        Event::listen('kitsoft::controller.formExtendQuery', function ($query) {
            $query->withTrashed();
        });

        // extend records
        if ($this->modelClass::make()->hasGlobalScope(new NestedTreeScope)) {
            Event::listen('backend.list.extendRecords', function ($controller, &$records) {
                $records = $this->listExtendRecords($records);
            });
        }
    }

    /**
     * onRestore
     */
    public function onRestore($id)
    {
        $object = $this->getValidObjectForRestore($id);

        if ($object->parent_id) {
            $parent = $object::where('id', $object->parent_id)->first();
            $nest_left = $parent->nest_right;
            $nest_right =  $parent->nest_right + 1;
            $nest_depth = $parent->nest_depth + 1;
        } else {
            $maxNestRight = $object::withoutGlobalScopes()->max('nest_right');
            $nest_left = $maxNestRight + 1;
            $nest_right =  $maxNestRight + 2;
            $nest_depth = 0;
        }

        $object->newQuery()
            ->withoutGlobalScopes()
            ->where($object->getKeyName(), $object->getKey())
            ->update([
                'nest_left' => $nest_left,
                'nest_right' => $nest_right,
                'nest_depth' => $nest_depth
            ]);

        $this->getValidObjectForRestore($id)->restore();
    }

    /**
     * onListRestore
     */
    public function onListRestore()
    {
        $checkedIds = request()->post('checked');

        Db::beginTransaction();
        try {
            foreach ($checkedIds as $id) {
                $this->onRestore($id);
            }
        } catch (Exception $e) {
            Db::rollback();
            throw new ApplicationException($e->getMessage());
        }

        Db::commit();

        return $this->controller->listRefresh();
    }

    /**
     * onForceDelete
     */
    public function onForceDelete(int $id)
    {
        $this->modelClass::onlyTrashed()
            ->where(function ($query) use ($id) {
                $query->where('id', $id)->orWhere('parent_id', $id);
            })
            ->get()
            ->each(function ($item) {
                $item->deleted_at = null;
                $item->forceDelete();
                $this->onForceDelete($item->id);
            });
    }

    /**
     * onListForceDelete
     */
    public function onListForceDelete()
    {
        $checkedIds = request()->post('checked');

        Db::beginTransaction();
        try {
            foreach ($checkedIds as $id) {
                $this->onForceDelete($id);
            }
        } catch (Exception $e) {
            Db::rollback();
            throw new ApplicationException($e->getMessage());
        }

        Db::commit();

        return $this->controller->listRefresh();
    }

    /**
     * listExtendQuery
     */
    protected function listExtendQuery($query)
    {
        if ($this->isTrash) {
            $query->onlyTrashed();
        } else {
            $query->withoutTrashed();
        }
    }

    /**
     * listExtendRecords
     */
    protected function listExtendRecords($records)
    {
        if (!$this->isTrash) {
            return $records;
        }
        
        $items = $this->modelClass::onlyTrashed()
            ->get()
            ->filter(function ($item) {
                return $item->isRoot() ?: $item->getParent()->count();
            })
            ->sortByDesc('deleted_at');

        return $this->setChildrenRelations($items);
    }

    /**
     * renderToolbarSidebar
     */
    protected function renderToolbarSidebar()
    {
        return $this->makePartial('sidebar', [
            'active' => $this->isTrash,
            'url' => request()->url() . '?trashed',
            'count' => $this->modelClass::onlyTrashed()->count()
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
     * setChildrenRelations recursive
     */
    protected function setChildrenRelations($items)
    {
        return $items->each(function ($item) {
            $childs = $item::withoutGlobalScope(new SoftDeletingScope)
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
     * getValidObjectForRestore
     */
    protected function getValidObjectForRestore(int $id)
    {
        $object = $this->modelClass::withoutGlobalScope(new SoftDeletingScope)
            ->find($id);

        if ($this->modelClass::make()->hasGlobalScope(new NestedTreeScope)) {
            if ($object->parent_id && !$object->parent) {
                throw new ApplicationException("Не можліво відновити, у сторінки [{$object->title}] не існує батьківської.");
            }
        }

        return $object;
    }
}
