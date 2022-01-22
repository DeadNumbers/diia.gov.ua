<?php namespace KitSoft\Revisions\Behaviors;

use BackendAuth;
use Illuminate\Support\Carbon;
use KitSoft\Revisions\Classes\Helpers;
use October\Rain\Database\NestedTreeScope;
use October\Rain\Extension\ExtensionBase;
use System\Models\Revision;
use ValidationException;
use Validator;
use Extension;

/**
 * RevisionsModel
 */
class RevisionsModel extends ExtensionBase
{
    use \October\Rain\Database\Traits\Revisionable;

    protected $model;
    protected $cleanUpDays = 30;
    protected $context;
    protected $excludeFields = [
        'created_at',
        'updated_at',
        'nest_right',
        'nest_left',
        'nest_depth'
    ];

    /**
     * Constructor
     */
    public function __construct($model)
    {
        $this->model = $model;

        $this->model->bindEvent('model.afterUpdate', function () {
            $this->afterUpdate();
        }, 5);

        $this->model->bindEvent('model.afterCreate', function () {
            $this->afterCreate();
        }, 5);

        $this->model->bindEvent('model.afterDelete', function () {
            $this->afterDelete();
        });
    }
    
    /**
     * setContext
     */
    public function setContext($context) {
        $this->context = $context;
    }

    /**
     * afterUpdate
     */
    protected function afterUpdate()
    {
        try {
            if (!$this->context) {
                $this->setContext('update');
            }

            $this->cleanUp();

            $old = $this->getOriginalAttributes();
            $current = $this->getCurrentAttributes();

            foreach ($current as $key => $row) {
                if (in_array($key, $this->excludeFields)) {
                    continue;
                }

                if (!isset($old[$key])) {
                    continue;
                }

                if ($row == $old[$key]) {
                    continue;
                }

                $this->createRevision(
                    $this->context,
                    $key,
                    $old[$key],
                    $row
                );
            }
        } catch (Exception $e) {
            trace_log($e);
        }
    }

    /**
     * afterCreate
     */
    protected function afterCreate()
    {
        try {
            $this->createRevision();
        } catch (Exception $e) {
            trace_log($e);
        }
    }

    /**
     * afterDelete
     */
    protected function afterDelete()
    {
        try {
            $old_value = json_encode($this->model->getAttributes());
            $this->createRevision('delete', null, $old_value, null);
        } catch (Exception $e) {
            trace_log($e);
        }
    }

    /**
     * createRevision
     */
    protected function createRevision($action = 'create', $field = null, $old = null, $new = null)
    {
        $revision = Revision::make();

        $revision->action = $action;
        $revision->user_id = BackendAuth::check() ? BackendAuth::getUser()->id : null;
        $revision->field = $field;
        $revision->old_value = is_array($old) ? json_encode($old) : $old;
        $revision->new_value = is_array($new) ? json_encode($new) : $new;
        $revision->revisionable_type = get_class($this->model);
        $revision->revisionable_id = $this->model->id;
        $revision->cast = $this->getAttributeCast($field);
        $revision->group = Helpers::getRevisionGroup($this->model);

        $revision->save();
    }

    /**
     * getOriginalAttributes
     */
    protected function getOriginalAttributes()
    {
        $attributes = $this->model->getOriginal();

        return $this->decodeJsonableAttributes($attributes);
    }

    /**
     * getCurrentAttributes
     */
    protected function getCurrentAttributes()
    {
        $attributes = $this->model->getAttributes();

        return $this->decodeJsonableAttributes($attributes);
    }

    /**
     * decodeJsonableAttributes
     */
    protected function decodeJsonableAttributes($attributes)
    {
        foreach ($attributes as $key => &$row) {
            $row = $this->model->isJsonable($key)
                ? json_decode($row, true)
                : $row;
        }

        return $attributes;
    }

    /**
     * cleanUp
     */
    protected function cleanUp()
    {
        Revision::withoutGlobalScopes()
            ->whereDate('created_at', '<=', Carbon::parse("-{$this->cleanUpDays} days"))
            ->get()
            ->each(function ($item) {
                $item->delete();
            });
    }

    /**
     * getAttributeCast
     */
    protected function getAttributeCast($field)
    {
        if (!$field) {
            return 'json';
        }
        if (in_array($field, $this->model->getDates())) {
            return 'date';
        }

        if ($this->model->isJsonable($field)) {
            return 'json';
        }

        return null;
    }
}
