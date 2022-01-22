<?php namespace KitSoft\MultiLanguage\Models;

use Model;
use October\Rain\Database\Collection;

/**
 * Entity Model
 */
class Entity extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_multilanguage_entities';

    public $timestamps = false;

    protected $primaryKey = null;

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'lang' => [Locale::class,
            'key' => 'locale',
            'otherKey' => 'code'
        ]
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * getObjectEntities
     */
    public static function getObjectEntities(Model $object): Collection
    {
        if (!$object->lang) {
            return collect();
        }

        return self::where('relation_id', $object->lang->relation_id)
            ->where('entity_type', $object->lang->entity_type)
            ->where('entity_id', '<>', $object->lang->entity_id)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->locale => $item];
            });
    }

    /**
     * object
     */
    public function object()
    {
        return $this->entity_type::withoutGlobalScopes()->find($this->entity_id);
    }

    /**
     * getModelEntities
     */
    public static function getModelEntities(Model $model): Collection {
        if (!$model->lang) {
            return collect();
        }

        return self::where('relation_id', $model->lang->relation_id)
            ->where('entity_type', get_class($model))
            ->where('entity_id', '<>', $model->id)
            ->get();
    }

    /**
     * createIfNotExist
     */
    public static function createIfNotExist(array $attributes) {
        $entity = self::make();

        foreach ($attributes as $key => $row) {
            $entity = $entity->where($key, $row);
        }

        if ($entity->count() == 0) {
            self::insert($attributes);
            return true;
        }

        return false;
    }
}
