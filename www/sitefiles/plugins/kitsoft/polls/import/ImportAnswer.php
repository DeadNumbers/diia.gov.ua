<?php namespace KitSoft\Polls\Import;

use Exception;
use KitSoft\Polls\Models\Answer;
use KitSoft\Polls\Models\Option;

class ImportAnswer
{
    /**
     * import
     */
    public static function import(array $attributes, Option $parentOption): Answer
    {
        self::validate($attributes);

        if (!$answer = self::find($attributes, $parentOption)) {
            $answer = Answer::make();
            $answer->attributes = $attributes;
            $answer->forceSave();

            // attach to parent option
            $parentOption->answer_id = $answer->id;
            $parentOption->forceSave();
        }

        return $answer;
    }

    /**
     * validate
     */
    protected static function validate($attributes)
    {
        if (!isset($attributes['title']) || empty($attributes['title'])) {
            throw new Exception('Title of option is not set.');
        }

        if (!isset($attributes['text']) || empty($attributes['text'])) {
            throw new Exception('Text of option is not set.');
        }
    }

    /**
     * find
     */
    protected static function find(array $attributes, Option $parentOption) {
        return Answer::where('title', $attributes['title'])
            ->where('text', $attributes['text'])
            ->whereHas('parent_option', function ($query) use ($parentOption) {
                return $query->where('id', $parentOption->id);
            })
            ->first();
    }
}