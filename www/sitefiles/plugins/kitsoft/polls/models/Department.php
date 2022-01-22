<?php namespace KitSoft\Polls\Models;

use Model;

/**
 * Department Model
 */
class Department extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_polls_departments';

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel'
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public $rules = [
        'title'   => 'required',
        'slug'    => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:kitsoft_polls_departments'],
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'answers' => [
            'KitSoft\Polls\Models\Answer',
            'table' => 'kitsoft_polls_departments_answers',
            'order' => 'title'
        ],
        'locations' => [
            'KitSoft\Polls\Models\Location',
            'table' => 'kitsoft_polls_departments_locations',
            'order' => 'title'
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'import_file' => [\System\Models\File::class, 'public' => false],
    ];
    public $attachMany = [];
}
