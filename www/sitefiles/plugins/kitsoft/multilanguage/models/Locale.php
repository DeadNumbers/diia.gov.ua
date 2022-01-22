<?php namespace KitSoft\MultiLanguage\Models;

use DB;
use Model;
use Cache;
use Lang;
use Event;
use Artisan;
use Exception;
use ValidationException;
use KitSoft\MultiLanguage\Models\Entity;
use KitSoft\MultiLanguage\Models\Message;

/**
 * Locale Model
 */
class Locale extends Model
{
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\Validation;

    public $rules = [
        'code' => ['required', 'unique:kitsoft_multilanguage_locales'],
        'label' => ['required'],
        'name' => ['required'],
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_multilanguage_locales';

    protected static $cacheListAvailable = null;

    public static $backendGetParam = 'lang';

    public $timestamps = false;

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public $hidden = [
        'id',
        'is_default',
        'is_enabled'
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
     * afterSave
     */
    public function afterSave()
    {
        Artisan::call('cache:clear');
    }

    /**
     * getDefault
     */
    public static function getDefault(): string
    {
        if (!$locale = self::where('is_default', 1)->first()) {
            throw new Exception('Default locale is not set');
        }
        $locale = $locale->code;

        Event::fire('kitsoft.multilanguage::locale.getDefault', [&$locale]);

        return $locale;
    }

    /**
     * listAvailable
     */
    public static function listAvailable()
    {
        if (self::$cacheListAvailable) {
            return self::$cacheListAvailable;
        }

        return self::$cacheListAvailable = self::lists('name', 'code');
    }

    /**
     * listEnabled
     */
    public static function listEnabled($field = 'name')
    {
        $locales = Cache::remember("kitsoft.multilanguage.locales.{$field}", 1440, function () use ($field) {
            return self::isEnabled()->lists($field, 'code');
        });

        Event::fire('kitsoft.multilanguage::locale.listEnabled', [&$locales]);

        return $locales;
    }

    /**
     * isAvailable
     */
    public static function isAvailable()
    {
        return count(self::listAvailable()) > 1;
    }

    /**
     * scopeIsEnabled
     */
    public function scopeIsEnabled($query)
    {
        return $query
            ->whereNotNull('is_enabled')
            ->where('is_enabled', true)
        ;
    }

    /**
     * afterCreate
     */
    public function afterCreate()
    {
        if ($this->is_default) {
            $this->makeDefault();
        }
    }

    /**
     * afterUpdate
     */
    public function afterUpdate()
    {
        if (!$this->isDirty('code')) {
            return;
        }

        Db::beginTransaction();
        try {
            // realions update
            $entities = Entity::where('locale', $this->original['code'])
                ->update(array('locale' => $this->code));

            // messages update
            $messages = Message::all();
            $messages->each(function ($item) {
                if (!array_key_exists($this->original['code'], $item->translates)) {
                    return;
                }
                $translates = $item->translates;
                $translates[$this->code] = $translates[$this->original['code']];
                unset($translates[$this->original['code']]);
                $item->translates = $translates;
                $item->save();
            });
        } catch (Exception $e) {
            Db::rollback();
            throw new ApplicationException('Error');
            return;
        }

        Db::commit();
    }

    /**
     * beforeDelete
     */
    public function beforeDelete()
    {
        if ($this->is_default) {
            throw new ApplicationException(Lang::get('":locale" is the default and cannot be deleted.', [
                'locale' => $this->name
            ]));
        }
    }

    /**
     * beforeUpdate
     */
    public function beforeUpdate()
    {
        $this->is_default = $this->is_default ? true : false;
        if ($this->isDirty('is_default')) {
            $this->makeDefault();

            if (!$this->is_default) {
                throw new ValidationException(['is_default' => Lang::get('":locale" is already default and cannot be unset as default.', ['locale' => $this->name])]);
            }
        }
    }

    /**
     * makeDefault
     */
    public function makeDefault($field = 'is_default')
    {
        if (!$this->is_enabled) {
            throw new ValidationException(['is_enabled' => Lang::get('":locale" is disabled and cannot be set as default.', ['locale'=>$this->name])]);
        }

        $this->newQuery()->where('id', $this->id)->update([$field => true]);
        $this->newQuery()->where('id', '<>', $this->id)->update([$field => false]);
    }

    /**
     * isValid
     */
    public static function isValid($locale)
    {
        $languages = array_keys(Locale::listAvailable());

        return in_array($locale, $languages);
    }

    /**
     * clearCache
     */
    public static function clearCache()
    {
        $cacheKey = 'kitsoft.multilanguage.locales';

        Event::fire('kitsoft.multilanguage::locale.listEnabledCacheKey', [&$cacheKey]);

        Cache::forget($cacheKey);

        Cache::forget('kitsoft.multilanguage.defaultLocale');
    }

    /**
     * getLangEntities
     * Get entities list (entity_id => locale) by relation_id and entity_type
     */
    public static function getLangEntities($relation_id, $entity_type)
    {
        return Entity::where('relation_id', $relation_id)
            ->where('entity_type', $entity_type)
            ->lists('locale', 'entity_id');
    }
}
