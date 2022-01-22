<?php namespace KitSoft\Polls\Models;

use KitSoft\Polls\Classes\ValidateQuestionCheckboxType;
use KitSoft\Polls\Models\Answer;
use KitSoft\Polls\Models\OptionLog;
use KitSoft\Polls\Models\Question;
use Model;

/**
 * Option Model
 */
class Option extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_polls_options';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public $rules = [
        'text'   => 'required',
        'action'    => 'required',
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'logs' => [OptionLog::class]
    ];
    public $belongsTo = [
        'answer' => [Answer::class],
        'question' => [Question::class]
    ];
    public $belongsToMany = [
        'parent_questions' => [
            Question::class,
            'table' => 'kitsoft_polls_questions_options',
            'otherKey' => 'question_id'
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * beforeValidate
     */
    public function beforeSave()
    {
        ValidateQuestionCheckboxType::option($this);
    }

    /**
     * getIsLastAttribute
     */
    public function getIsLastAttribute()
    {
        return ($this->action == 'answer');
    }
}
