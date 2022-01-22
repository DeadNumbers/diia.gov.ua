<?php namespace KitSoft\Polls\Import;

use Exception;
use KitSoft\Polls\Models\Option;
use KitSoft\Polls\Models\Question;

class ImportOption
{
    /**
     * import
     */
    public static function import(array $attributes, Question $question): Option
    {
        self::validate($attributes);

        if (!$option = self::find($attributes, $question)) {
            $option = Option::make();
            $option->attributes = $attributes;
            $option->forceSave();

            $question->options()->attach($option->id);
        }

        return $option;
    }

    /**
     * validate
     */
    protected static function validate($attributes)
    {
        if (!isset($attributes['text']) || empty($attributes['text'])) {
            throw new Exception('Text of option is not set.');
        }

        if (!isset($attributes['action'])) {
            throw new Exception('Action of option is not set.');
        }
    }

    /**
     * find
     */
    protected static function find(array $attributes, Question $question) {
        return Option::where('text', $attributes['text'])
            ->where('action', $attributes['action'])
            ->whereHas('parent_questions', function ($query) use ($question) {
                return $query->where('id', $question->id);
            })
            ->first();
    }
}