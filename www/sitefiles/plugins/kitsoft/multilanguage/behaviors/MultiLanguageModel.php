<?php namespace KitSoft\MultiLanguage\Behaviors;

use App;
use Builder;
use Db;
use DbDongle;
use Event;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\MultiLanguage\Models\Entity;
use Model;
use October\Rain\Extension\ExtensionBase;
use Request;
use ValidationException;

/**
 * Base class for model behaviors.
 */
class MultiLanguageModel extends ExtensionBase
{
    public $translatable = true;

    protected $ml;
    protected $model;
    protected $activeLocale;
    protected $defaultLocale;
    protected $relationId;
    protected $relationIdParam = 'relation_id';

    /**
     * Constructor
     */
    public function __construct($model)
    {
        $this->model = $model;

        $this->setLangs();
        $this->setRelation();

        // add global scope
        $this->model::addGlobalScope('translate', function ($builder) {
            $builder->trans();
        });

        // model lang
        $this->model->belongsTo['lang'] = [
            'KitSoft\MultiLanguage\Models\Entity',
            'key' => 'id',
            'otherKey' => 'entity_id',
            'conditions' => "entity_type = '" . get_class($this->model) . "'"
        ];

        $this->model->addHidden([
            'locale',
            'entity_id',
            'relation_id',
            'entity_type'
        ]);

        // model langs
        $this->model->addDynamicMethod('langs', function () {
            return $this->getLangsAttribute();
        });

        // check if already exist model with this entity and locale
        $this->model->bindEvent('model.beforeCreate', function () {
            if ($this->relationId) {
                $entity = Entity::where('locale', $this->activeLocale)
                    ->where('relation_id', $this->relationId)
                    ->where('entity_type', get_class($this->model))
                    ->first();
                if ($entity) {
                    $this->redirectNewModel($entity->entity_id);
                }
            }
        });

        // after create model, store locale entity
        $this->model->bindEvent('model.afterCreate', function () {
            $this->storeLang();
        }, 100);

        // after delete model, delete entity
        $this->model->bindEvent('model.afterDelete', function () {
            $this->deleteEntity();
        }, 100);

        // redefine slug validation, must unique for current language
        $this->model->bindEvent('model.beforeValidate', function () {
            $this->rebuildValidationRule('slug');
            $this->rebuildValidationRule('code');
        });
    }

    /**
     * getLangsAttribute
     */
    public function getLangsAttribute()
    {
        return Entity::getObjectEntities($this->model);
    }

    /**
     * setLang
     */
    public function setLang($locale)
    {
        $this->activeLocale = $locale;
    }

    /**
     * Set default and active languages
     * Active is different for frontend and backend
     */
    public function setLangs()
    {
        $this->ml = MultiLanguage::instance();

        $this->defaultLocale = $this->ml->getDefaultLocale();
        $this->activeLocale = $this->ml->getActiveLocale();
    }

    /**
     * Set relation id, if isset, for creating related models
     */
    public function setRelation()
    {
        $this->relationId = Request::has($this->relationIdParam)
            ? Request::get($this->relationIdParam)
            : null;
    }

    /**
     * Save model locale and entity
     */
    protected function storeLang()
    {
        if (!$locale = $this->activeLocale) {
            throw new ValidationException(['Active locale is not set.']);
        }

        // if model already has entity, validate id
        if ($this->relationId) {
            $entity = Entity::where('relation_id', $this->relationId)
                ->where('entity_type', get_class($this->model))
                ->first();
            if (!$entity) {
                throw new ValidationException(['Unknown relation_id for this model.']);
            }
            $entity_id = $entity->relation_id;
        // or create new entity, by this model id
        } else {
            $entity_id = $this->model->getKey();
        }

        Db::table('kitsoft_multilanguage_entities')->insert([
            'locale' => $locale,
            'entity_id' => $this->model->getKey(),
            'relation_id' => $entity_id,
            'entity_type' => get_class($this->model)
        ]);
    }

    /**
     * Delete Entity after rm model
     */
    protected function deleteEntity()
    {
        if ($this->model->hasGlobalScope(new SoftDeletingScope) && $this->model->deleted_at) {
            return;
        }

        return Entity::where('entity_id', $this->model->id)
            ->where('entity_type', get_class($this->model))
            ->delete();
    }

    /**
     * Filter model by active locale
     */
    public function scopeTrans($query, $locale = false)
    {
        return $query
            ->join(
                'kitsoft_multilanguage_entities as kmr',
                "{$this->model->getTable()}.id",
                '=',
                'kmr.entity_id'
            )
            ->where('kmr.entity_type', '=', get_class($this->model))
            ->where('kmr.locale', '=', $locale ?: $this->activeLocale);
    }

    /**
     * redirectNewModel
     */
    protected function redirectNewModel($id)
    {
        $segments = Request::segments();
        end($segments);
        $segments[key($segments)] = 'update';
        $segments[] = $id;

        header("Location: /" . implode('/', $segments));
        die();
    }

    /**
     * rebuildValidationRule
     */
    protected function rebuildValidationRule($field)
    {
        if (!isset($this->model->rules[$field])) {
            return;
        }

        $rules = $this->model->rules[$field];
        $rules = is_array($rules)
            ? $rules
            : explode('|', $rules);

        $rule = 'transUnique:' . get_class($this->model) . ',' . $this->model->id;

        foreach ($rules as &$row) {
            if (!strstr($row, 'unique:')) {
                continue;
            }
            $row = $rule;
        }

        $this->model->rules[$field] = $rules;
    }
}
