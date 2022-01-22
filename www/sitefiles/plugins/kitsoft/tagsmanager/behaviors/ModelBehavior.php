<?php

namespace KitSoft\TagsManager\Behaviors;

use KitSoft\TagsManager\Models\Entity;
use KitSoft\TagsManager\Models\Tag;
use October\Rain\Extension\ExtensionBase;

class ModelBehavior extends ExtensionBase
{
	public $model;

	/**
	 * __construct
	 */
	public function __construct($model) {
		$this->model = $model;

		$this->model->morphToMany = [
        	'tags' => [
        		'KitSoft\TagsManager\Models\Tag',
        		'name' => 'entity',
        		'table' => 'kitsoft_tagsmanager_entities',
        		'order' => 'name asc'
        	]
    	];

    	// after delete model, delete entity
        $this->model->bindEvent('model.afterDelete', function () {
            $this->deleteEntity();
        });
	}

	/**
	 * scopeFilterTags
	 */
	public function scopeFilterTags($query, $tags = [], $column = 'id') {
        return $query->whereHas('tags', function($query) use ($tags, $column) {
            $query->whereIn($column, $tags);
        });
	}

	/**
	 * deleteEntity
	 */
	protected function deleteEntity() {
        return Entity::where('entity_id', $this->model->id)
            ->where('entity_type', get_class($this->model))
            ->delete();
	}

	/**
	 * getTagsOptions
	 */
	public function getTagsOptions()
	{
		return Tag::orderBy('name')
			->lists('name', 'id');
	}
}
