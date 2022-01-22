<?php namespace KitSoft\Faq\Models;

use Model;

/**
 * Category Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\NestedTree;
    use \October\Rain\Database\Traits\Validation;

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
        '@KitSoft.Pages.Behaviors.RelationFinderModel'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_faq_categories';

    public $relationFinder = [
        'nameFrom' => 'name'
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
        'name' => 'required|max:191',
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:kitsoft_faq_categories', 'max:191']
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'questions' => ['KitSoft\Faq\Models\Question',
            'table' => 'kitsoft_faq_questions_categories',
            'scope' => 'isPublished'
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /*
     * scopeIsTop
     */
    public function scopeIsTop($query) {
        return $query->where('is_top', true);
    }
}
