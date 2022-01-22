<?php namespace KitSoft\Polls\Models;

use KitSoft\Polls\Models\Option;
use Model;

/**
 * Answer Model
 */
class Answer extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_polls_answers';

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
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [
        'parent_option' => [Option::class, 'key' => 'question_id']
    ];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'departments' => [
            'KitSoft\Polls\Models\Department',
            'table' => 'kitsoft_polls_departments_answers',
            'order' => 'title'
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
