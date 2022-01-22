<?php namespace KitSoft\TaxSystems\Models;

use KitSoft\TaxSystems\Models\EntrepreneurOption;
use Model;

/**
 * EntrepreneurQuestion Model
 */
class EntrepreneurQuestion extends Model
{
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\Validation;

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_taxsystems_entrepreneur_questions';

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
    public $rules = [
        'title' => 'required|max:191',
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:kitsoft_taxsystems_entrepreneur_questions', 'max:191'],
        'published' => 'boolean',
        'sort_order' => 'integer'
    ];

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
    public $hasMany = [
        'entrepreneur_options' => [EntrepreneurOption::class,
            'order' => 'sort_order',
        ]
    ];
    public $belongsTo = [
        'depends_on_question' => [EntrepreneurQuestion::class],
        'depends_on_option' => [EntrepreneurOption::class],
    ];
    public $belongsToMany = [

    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * beforeCreate
     */
    public function beforeCreate()
    {
        $this->sort_order = self::withoutGlobalScopes()->max('sort_order') + 1;
    }

    /**
     * beforeUpdate
     */
    public function beforeUpdate()
    {
        if (!$this->depends_on_question) {
            $this->depends_on_option = null;
        }
    }
    
    /**
     * scopeIsPublished
     */
    public function scopeIsPublished($query)
    {
        return $query
            ->whereNotNull('published')
            ->where('published', true);
    }

    /**
     * getInputNameAttribute
     */
    public function getInputNameAttribute()
    {
        return sprintf('question_%d', $this->id);
    }

    /**
     * getDependsOnOptionOptions
     */
    public function getDependsOnOptionOptions()
    {
        if (!$this->depends_on_question) {
            return [];
        }

        if (!$question = self::find($this->depends_on_question->id)) {
            return [];
        }

        return $question->entrepreneur_options->lists('text', 'id');
    }
}
