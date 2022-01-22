<?php namespace KitSoft\Digest\Models;

use Event;
use Model;

/**
 * ListSync Model
 */
class ListSync extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_digest_lists_sync';

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
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * getSyncIdOptions
     */
    public function getSyncIdOptions()
    {
        $options = [];
        Event::fire('kitsoft.digest::get_sync_id_options', [&$options]);

        return $options;
    }
}
