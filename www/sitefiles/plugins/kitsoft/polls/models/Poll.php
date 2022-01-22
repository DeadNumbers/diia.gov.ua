<?php namespace KitSoft\Polls\Models;

use KitSoft\Polls\Models\Log;
use KitSoft\Polls\Models\Question;
use Model;

/**
 * Poll Model
 */
class Poll extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_polls_polls';

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
    public $hasOne = [];
    public $hasMany = [
        'logs' => [Log::class]
    ];
    public $belongsTo = [
        'question' => [Question::class]
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'import_file' => [\System\Models\File::class, 'public' => false],
    ];
    public $attachMany = [];

    /**
     * beforeDelete
     */
    public function beforeDelete()
    {
        if ($this->question) {
            $this->question->delete();
        }
    }

    /**
     * getPollOptions
     */
    public function getPollOptions()
    {
        return self::orderBy('title')
            ->lists('title', 'id');
    }

    /**
     * getOptionsList
     */
    public function getOptionsList()
    {
        if (!$this->poll_id) {
            return [];
        }

        $poll = self::find($this->poll_id);

        if (!$poll->question) {
            return [];
        }

        return $poll->question
            ->options()
            ->where('action', 'question')
            ->whereDoesntHave('answer')
            ->lists('text', 'id');
    }

    /**
     * getAllQuestionsAttribute
     */
    public function getAllQuestionsAttribute()
    {
        return $this->question
            ? $this->getAllQuestions($this->question)
            : collect();
    }

    /**
     * getAllQuestions
     */
    protected function getAllQuestions(Question $question)
    {
        $questions = collect()->push($question);

        $question->options->each(function ($item) use (&$questions) {
            if (!$item->question) {
                return;
            }
            $questions = $questions->merge($this->getAllQuestions($item->question));
        });

        return $questions->unique('id');
    }
}
