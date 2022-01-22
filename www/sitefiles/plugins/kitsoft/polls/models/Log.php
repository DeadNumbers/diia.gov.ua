<?php namespace KitSoft\Polls\Models;

use KitSoft\Polls\Models\Poll;
use Model;
use Exception;

/**
 * Log Model
 */
class Log extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_polls_logs';

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
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = ['log'];

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
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * store
     */
    public static function store(Poll $poll, array $attributes): Log
    {
        if (!array_get($attributes, 'options')) {
            throw new Exception('Invalid data for poll logger');
        }

        $object = self::make();

        $object->log = $poll->all_questions
            ->filter(function ($item) use ($attributes) {
                return (boolean)$item->options->whereIn('id', $attributes['options'])->count();
            })
            ->transform(function ($question) use ($attributes) {
                return [
                    'id' => $question->id,
                    'title' => $question->title,
                    'options' => $question->options
                        ->whereIn('id', $attributes['options'])
                        ->transform(function ($option) use ($attributes) {
                            $result = [
                                'id' => $option->id,
                                'text' => $option->text
                            ];

                            if ($comment = array_get($attributes, "comments.{$option->id}")) {
                                $result['comment'] = $comment;
                            }

                            return $result;
                        })
                ];
            });

        $object->ip = request()->ip();
        $object->poll_id = $poll->id;

        $object->save();

        return $object;
    }
}
