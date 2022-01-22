<?php namespace KitSoft\Polls\Models;

use KitSoft\Polls\Classes\ValidateQuestionCheckboxType;
use KitSoft\Polls\Models\Option;
use KitSoft\Polls\Models\Poll;
use Model;

/**
 * Question Model
 */
class Question extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_polls_questions';

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel'
    ];

    public $rules = [
        'title'   => 'required',
        'text' => 'required',
        'type' => 'required|in:radio,checkbox,select'
    ];

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
    public $hasOne = [
        'parent_poll' => [Poll::class, 'key' => 'question_id'],
    ];
    public $hasMany = [
        'parent_options' => [Option::class, 'key' => 'question_id']
    ];
    public $belongsTo = [];
    public $belongsToMany = [
        'options' => [
            Option::class,
            'table' => 'kitsoft_polls_questions_options',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * beforeValidate
     */
    public function beforeValidate()
    {
        ValidateQuestionCheckboxType::question($this);
    }

    /**
     * beforeDelete
     */
    public function beforeDelete()
    {
        $this->options->each(function ($item) {
            $item->delete();
        });
    }

    /**
     * getGroupedOptionsAttribute
     */
    public function getGroupedOptionsAttribute()
    {
        return $this->options->groupBy('question.title');
    }

    /**
     * getSubQuestionsAttribute
     */
    public function getSubQuestionsAttribute()
    {
        $subQuestions = collect();

        $this->options->each(function ($item) use (&$subQuestions) {
            if ($item->question) {
                $subQuestions->push($item->question);
            }
        });

        return $subQuestions->unique('id')
            ->sortBy('title');
    }

    /**
     * getSubAnswersAttribute
     */
    public function getSubAnswersAttribute()
    {
        $subAnswers = collect();

        $this->options->each(function ($item) use (&$subAnswers) {
            if ($item->answer) {
                $subAnswers->push($item->answer);
            }
        });

        return $subAnswers->unique('id')
            ->sortBy('title');
    }

    /**
     * isConfigured
     */
    public function isConfigured()
    {
        if ($this->options->where('action', null)->count()) {
            return false;
        }

        if ($this->options->where('action', 'question')->where('question_id', null)->count()) {
            return false;
        }

        if ($this->options->where('action', 'answer')->where('answer_id', null)->count()) {
            return false;
        }

        return true;
    }

    /**
     * getTypeOptions
     */
    public function getTypeOptions()
    {
        return [
            'radio' => 'Radio',
            'checkbox' => 'Checkbox',
            //'select' => 'Select'
        ];
    }
}
