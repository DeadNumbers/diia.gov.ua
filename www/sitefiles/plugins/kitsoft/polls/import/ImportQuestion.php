<?php namespace KitSoft\Polls\Import;

use Exception;
use KitSoft\Polls\Models\Option;
use KitSoft\Polls\Models\Poll;
use KitSoft\Polls\Models\Question;

class ImportQuestion
{
    /**
     * import
     */
    public static function import(
        array $attributes,
        Poll $parent_poll = null,
        $parent_options = null
    ): Question {
        self::validate($attributes);

        // create question
        if (!$question = self::find($attributes, $parent_poll, $parent_options)) {
            $question = Question::make();
            $question->attributes = $attributes;
            $question->forceSave();

            // attach to poll
            if ($parent_poll) {
                $parent_poll->question_id = $question->id;
                $parent_poll->forceSave();
            }

            // attach to previous option
            if ($parent_options) {
                foreach ($parent_options as $parent_option) {
                    $parent_option->question_id = $question->id;
                    $parent_option->forceSave();
                }
            }
        }

        return $question;
    }

    /**
     * validate
     */
    protected static function validate($attributes)
    {
        if (!isset($attributes['title']) || empty($attributes['title'])) {
            throw new Exception('Title of question is not set.');
        }
    }

    /**
     * find
     */
    protected static function find(
        array $attributes,
        Poll $parent_poll = null,
        $parent_options = null
    ) {
        $query = Question::where('title', $attributes['title']);

        if ($parent_poll) {
            $query = $query->whereHas('parent_poll', function ($query) use ($parent_poll) {
                return $query->where('id', $parent_poll->id);
            });
        }

        if ($parent_options) {
            $query = $query->whereHas('parent_options', function ($query) use ($parent_options) {
                return $query->whereIn('id', $parent_options->lists('id'));
            });
        }

        return $query->first();
    }
}