<?php namespace KitSoft\Services\Models;

use ApplicationException;
use Backend\Models\ImportModel;
use Exception;
use KitSoft\Services\Models\Service;
use KitSoft\Services\Models\SubCategory;

/**
 * Service Import Model
 */
class ServiceImport extends ImportModel
{
    public $table = 'kitsoft_services_services';

    /**
     * Validation rules
     */
    public $rules = [
        'slug' => 'string',
        'title'   => 'required',
        'content' => 'required',
        'type' => 'in:link,content',
        'is_top' => 'boolean',
        'published' => 'boolean',
        'hits' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'subcategories_names' => 'string',
        'related_services_slugs' => 'string'
    ];

    protected $exceptFields = [
        'subcategories_names',
        'related_services_slugs'
    ];

    /**
     * importData
     */
    public function importData($results, $sessionKey = null)
    {
        $firstRow = reset($results);

        foreach ($results as $row => $data) {
            try {
                $object = Service::make();

                if ($this->findDuplicatePost($data)) {
                    continue;
                }

                foreach (array_except($data, $this->exceptFields) as $attribute => $value) {
                    $object->{$attribute} = $value ?: null;
                }

                $object->slug = $object->slug ?? str_slug($object->title);
                $object->published = (boolean)$this->is_published;
                $object->forceSave();

                if ($subcategoryIds = $this->getSubCategoryIdsForService($data)) {
                    $object->subcategories()->sync($subcategoryIds);
                }

                $this->logCreated();
            }
            catch (Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }

        // attach related services
        foreach ($results as $row => $data) {
            try {
                $slug = $data['slug'] ?? str_slug($data['title']);
                $object = Service::where('slug', $slug)->first();

                if ($relatedServicesIds = $this->getRelatedServicesIdsForService($data)) {
                    $object->related_services()->sync($relatedServicesIds);
                }
            }
            catch (Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }

    /**
     * findDuplicatePost
     */
    protected function findDuplicatePost($data)
    {
        if ($id = array_get($data, 'id')) {
            return Service::find($id);
        }

        if ($slug = array_get($data, 'slug')) {
            Service::where('slug', $slug)->first();
        }

        return;
    }

    /**
     * getSubCategoryIdsForService
     */
    protected function getSubCategoryIdsForService($data)
    {
        if (!$subcategories = array_get($data, 'subcategories_names')) {
            return;
        }

        if ($subcategories == 'NULL') {
            return;
        }

        $result = [];
        $subcategories = explode(',', $subcategories);

        foreach ($subcategories as $name) {
            $slug = str_slug($name);
            if (!$subcategory = SubCategory::where('slug', $slug)->first()) {
                $subcategory = SubCategory::make();
                $subcategory->name = $name;
                $subcategory->slug = $slug;
                $subcategory->save();
            }

            $result[] = $subcategory->id;
        }

        return $result;
    }

    /**
     * getRelatedServicesIdsForService
     */
    protected function getRelatedServicesIdsForService($data)
    {
        if (!$related_services = array_get($data, 'related_services_slugs')) {
            return;
        }

        if ($related_services == 'NULL') {
            return;
        }

        $related_services = explode(',', $related_services);

        return Service::whereIn('slug', $related_services)
            ->lists('id');
    }
}
