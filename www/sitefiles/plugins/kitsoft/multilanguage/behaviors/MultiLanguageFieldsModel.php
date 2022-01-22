<?php namespace KitSoft\MultiLanguage\Behaviors;

use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\MultiSite\Models\Site;
use October\Rain\Extension\ExtensionBase;

/**
 * MultiLanguageFieldsModel
 */
class MultiLanguageFieldsModel extends ExtensionBase
{
    protected $model;

    /**
     * Constructor
     */
    public function __construct($model)
    {
        $this->model = $model;

        $this->model->morphMany['translations'] = [
            'KitSoft\MultiLanguage\Models\Field',
            'name' => 'entity'
        ];

        $this->model->bindEvent('model.afterFetch', function () {
            if ($this->model instanceof Site) {
                return;
            }
            $this->model->translateFields();
        });
    }

    /**
     * translateFields
     */
    public function translateFields()
    {
        if (!$this->model->translatable) {
            return;
        }

        $locale = MultiLanguage::instance()->getActiveLocale();

        foreach ($this->model->translatable as $field) {
            $this->model->{$field} = $this->translateField($field, $locale);
        }

        return $this->model;
    }

    /**
     * translateFields
     */
    public function translateField(string $field, string $locale = null)
    {
        $locale = $locale ?? $locale = MultiLanguage::instance()->getActiveLocale();
        
        if (!$translation = $this->model->translations->where('locale', $locale)->first()) {
            return $this->model->{$field};
        }

        return $translation->value;
    }

    /**
     * scopeTranslateFieldWhere
     */
    public function scopeTranslateFieldWhere($query, string $field, string $action = '=', string $value)
    {
        $locale = MultiLanguage::instance()->getActiveLocale();

        return $query->whereHas('translations', function ($query) use ($locale, $action, $value) {
            return $query->where('locale', $locale)
                ->where('value', $action, $value);
        });
    }

    /**
     * scopeOrTranslateFieldWhere
     */
    public function scopeOrTranslateFieldWhere($query, string $field, string $action = '=', string $value)
    {
        $locale = MultiLanguage::instance()->getActiveLocale();

        return $query->orWhereHas('translations', function ($query) use ($locale, $action, $value) {
            return $query->where('locale', $locale)
                ->where('value', $action, $value);
        });
    }

    /**
     * scopeTranslatesFieldWhere
     */
    public function scopeTranslatesFieldWhere($query, string $field, string $action = '=', string $value)
    {
        return $query->whereHas('translations', function ($query) use ($action, $value) {
            return $query->where('value', $action, $value);
        });
    }

    /**
     * scopeOrTranslatesFieldWhere
     */
    public function scopeOrTranslatesFieldWhere($query, string $field, string $action = '=', string $value)
    {
        return $query->orWhereHas('translations', function ($query) use ($action, $value) {
            return $query->where('value', $action, $value);
        });
    }
}
