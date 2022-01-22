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
class ArchivedModel extends ExtensionBase
{
    protected $model;

    /**
     * Constructor
     */
    public function __construct($model)
    {
        $this->model = $model;

        // add global scope
        $this->model::addGlobalScope('withoutArchived', function ($builder) {
            $builder->withoutArchived();
        });
    }

    /**
     * scopeOnlyArchived
     */
    public function scopeOnlyArchived($query)
    {
        return $query->withoutGlobalScope('withoutArchived')
            ->whereNotNull('archived_at');
    }

    /**
     * scopeWithArchived
     */
    public function scopeWithArchived($query)
    {
        return $query->withoutGlobalScope('withoutArchived');
    }

    /**
     * scopeWithoutArchived
     */
    public function scopeWithoutArchived($query)
    {
        return $query->whereNull('archived_at');
    }

    /**
     * isArchived
     */
    public function isArchived()
    {
        return $this->model->archived_at;
    }

    /**
     * archivate
     */
    public function archivate()
    {
        $data = ['archived_at' => $this->model->freshTimestamp()];

        if ($this->model::hasGlobalScope(new NestedTreeScope)) {
            $this->archiveDescendants();
            $data['nest_left'] = $data['nest_right'] = 0;
        }

        $this->model::where($this->model->getKeyName(), $this->model->getKey())
            ->get()
            ->each(function ($item) use ($data) {
                $item->attributes = array_merge($item->attributes, $data);
                $item->save();
            });
    }

    /**
     * unarchivate
     */
    public function unarchivate()
    {
        $this->model->archived_at = null;
        $this->prepareUnarchiveNested();
        $this->model->save();
    }

    /**
     * archiveDescendants
     */
    protected function archiveDescendants()
    {
        if (!$this->model::hasGlobalScope(new NestedTreeScope)) {
            return;
        }
        if ($this->model->getRight() === null || $this->model->getLeft() === null) {
            return;
        }

        $this->model->getConnection()->transaction(function () {
            $this->model->reload();

            $leftCol = $this->model->getLeftColumnName();
            $rightCol = $this->model->getRightColumnName();
            $left = $this->model->getLeft();
            $right = $this->model->getRight();

            /*
             * archive children
             */
            $this->model->newQuery()
                ->where($leftCol, '>', $left)
                ->where($rightCol, '<', $right)
                ->update([
                    'archived_at' => date('Y-m-d H:i:s'),
                    'nest_left' => 0,
                    'nest_right' => 0
                ]);

            /*
             * Update left and right indexes for the remaining nodes
             */
            $diff = $right - $left + 1;

            $this->model->newQuery()
                ->where($leftCol, '>', $right)
                ->decrement($leftCol, $diff)
            ;

            $this->model->newQuery()
                ->where($rightCol, '>', $right)
                ->decrement($rightCol, $diff)
            ;
        });
    }

    /**
     * unarchiveDescendants
     */
    protected function prepareUnarchiveNested()
    {
        if (!$this->model::hasGlobalScope(new NestedTreeScope)) {
            return;
        }

        if ($this->model->parent_id) {
            $parent = $this->model::find($this->model->parent_id);
            $this->model->nest_left = $parent->getRight();
            $this->model->nest_right =  $parent->getRight() + 1;
            $this->model->nest_depth = $parent->getDepth() + 1;
        } else {
            $maxNestRight = $this->model::withoutGlobalScopes()->max('nest_right');
            $this->model->nest_left = $maxNestRight + 1;
            $this->model->nest_right =  $maxNestRight + 2;
            $this->model->nest_depth = 0;
        }

        $this->model->newQuery()
            ->withoutGlobalScopes()
            ->where($this->model->getKeyName(), $this->model->getKey())
            ->update([
                'nest_left' => $this->model->nest_left,
                'nest_right' => $this->model->nest_right,
                'nest_depth' => $this->model->nest_depth
            ]);

        $this->model->shiftSiblingsForRestore();
    }
}
