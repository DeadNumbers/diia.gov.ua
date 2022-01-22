<?php namespace KitSoft\Digest\Models;

use Event;
use KitSoft\Digest\Models\Settings;
use Model;

/**
 * Subscriber Model
 */
class Subscriber extends Model
{
    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
        '@KitSoft.TagsManager.Behaviors.ModelBehavior'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_digest_subscribers';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public $jsonable = ['content_types'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'lists' => [
            'KitSoft\Digest\Models\ListSync',
            'table' => 'kitsoft_digest_subscribers_lists',
            'otherKey' => 'list_id',
            'order' => 'title'
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * afterDelete
     */
    public function afterDelete()
    {
        Event::fire('kitsoft.digest::subscriber.afterDelete', [$this]);
    }

    /**
     * afterSave
     */
    public function afterSave()
    {
        Event::fire('kitsoft.digest::subscriber.afterSave', [$this]);
    }

    /**
     * afterCreate
     */
    public function afterCreate()
    {
        Event::fire('kitsoft.digest::subscriber.create', [$this]);
    }

    /**
     * getListsStringAttribute
     */
    public function getListsStringAttribute()
    {
        return $this->lists->implode('title', ', ');
    }

    /**
     * getTagsStringAttribute
     */
    public function getTagsStringAttribute()
    {
        return $this->tags->implode('name', ', ');
    }

    /**
     * getByUniqueId
     */
    public static function getByUniqueId($uuid)
    {
        return  self::where('sync_uuid', $uuid)->first();
    }

    /**
     * getContentTypesOptions
     */
    public function getContentTypesOptions()
    {
        return Settings::instance()
            ->getActiveTypesOptions();
    }
}
