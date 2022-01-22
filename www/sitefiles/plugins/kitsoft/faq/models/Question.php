<?php namespace KitSoft\Faq\Models;

use KitSoft\Forms\Models\Form;
use KitSoft\Forms\Models\Inbox;
use Model;
use Lang;

/**
 * Question Model
 */
class Question extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
        '@KitSoft.Pages.Behaviors.RelationFinderModel'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_faq_questions';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $jsonable = ['fields'];

    public $rules = [
        'question' => 'required',
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'categories' => [
            'KitSoft\Faq\Models\Category',
            'table' => 'kitsoft_faq_questions_categories'
        ],
        'related_questions' => [
            'KitSoft\Faq\Models\Question',
            'table' => 'kitsoft_faq_questions_related',
            'key' => 'question_id',
            'otherKey' => 'related_id',
            'order' => 'question'
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * scopeIsPublished
     */
    public function scopeIsPublished($query)
    {
        return $query->whereNotNull('published')
            ->where('published', true);
    }

    /*
     * scopeIsTop
     */
    public function scopeIsTop($query) {
        return $query->where('is_top', true);
    }

    /**
     * getInboxCount
     */
    public static function getInboxCount()
    {
        if (!$form = Form::where('code', 'faq')->first()) {
            return;
        }

        return Inbox::where('form_id', $form->id)
            ->isNew()
            ->count();
    }

    /**
     * getAnswerTypeOptions
     */
    public function getAnswerTypeOptions()
    {
        return [
            'answer' =>  Lang::get('kitsoft.faq::lang.question.fields.answer_type_options.answer'),
            'link' =>  Lang::get('kitsoft.faq::lang.question.fields.answer_type_options.link')
        ];
    }

    /**
     * scopeFilterWithoutCategories
     */
    public function scopeFilterWithoutCategories($query)
    {
        return $query = $query->whereDoesntHave('categories');
    }

    /**
     * getTitleAttribute
     */
    public function getTitleAttribute()
    {
        return $this->question;
    }

    /*
     * getUrlAttribute
     */
    public function getUrlAttribute()
    {
        if ($this->answer_type == 'link') {
            return $this->link;
        }

        return $this->asExtension('KitSoft.Pages.Behaviors.RelationFinderModel')
            ->getUrlAttribute();
    }

    /**
     * getFullUrlAttribute
     */
    public function getFullUrlAttribute()
    {
        if ($this->answer_type == 'link') {
            return $this->link;
        }

        return $this->asExtension('KitSoft.Pages.Behaviors.RelationFinderModel')
            ->getFullUrlAttribute();
    }
}
