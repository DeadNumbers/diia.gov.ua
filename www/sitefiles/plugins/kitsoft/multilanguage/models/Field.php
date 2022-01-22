<?php namespace KitSoft\MultiLanguage\Models;

use Model;

/**
 * Field Model
 */
class Field extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_multilanguage_fields';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * get
     */
    public static function get(Model $object, string $locale)
    {
        $item = self::where('locale', $locale)
            ->where('entity_type', get_class($object))
            ->where('entity_id', $object->id)
            ->first();

        if ($item) {
            return $item->value;
        }
    }

    /**
     * createOrUpdate
     */
    public static function createOrUpdate(Model $object, string $locale, string $value): Field
    {
        $item = self::where('locale', $locale)
            ->where('entity_type', get_class($object))
            ->where('entity_id', $object->id)
            ->first();

        if (!$item) {
            $item = self::make();

            $item->locale = $locale;
            $item->entity_type = get_class($object);
            $item->entity_id = $object->id;
        }

        $item->value = $value;

        $item->save();

        return $item;
    }

    /**
     * remove
     */
    public static function remove(Model $object, string $locale)
    {
        return self::where('locale', $locale)
            ->where('entity_type', get_class($object))
            ->where('entity_id', $object->id)
            ->delete();
    }
}
