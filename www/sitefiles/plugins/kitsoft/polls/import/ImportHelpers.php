<?php namespace KitSoft\Polls\Import;

use KitSoft\Polls\Import\ImportAnswer;
use KitSoft\Polls\Import\ImportOption;
use KitSoft\Polls\Import\ImportQuestion;
use KitSoft\Polls\Models\Option;
use KitSoft\Polls\Models\Poll;

class ImportHelpers
{
    /**
     * removeData
     */
    public static function removeData($poll_id, $option_ids = null)
    {
        if ($option_ids) {
            Option::whereIn('id', $option_ids)->get()->each(function ($item) {
                if (!$item->question) {
                    return;
                }
                $item->question->delete();
            });

            return;
        }

        if ($poll_id) {
            $poll = Poll::find($poll_id);

            if ($poll->question) {
                $poll->question->delete();
            }
        }
    }

    /**
     * importRow
     */
    public static function importRow($item, $matches)
    {
        $option = null;
        $count = count($matches);

        for ($i = 0; $i < $count; $i++) {
            if ($i == ($count - 1)) {
                continue;
            }

            // create question if not exist, attach it to parent poll ot options
            $question = ImportQuestion::import(
                [
                    'title' => $matches[$i] . ' ' . ($option ? $option->text : null),
                    'text' => ''
                ],
                self::importRowGetPoll($i),
                self::importRowGetOptions($i, $option)
            );

            // create option, attach it to question
            $option = ImportOption::import([
                'text' => $item[$i],
                'action' => ($i == ($count - 2)) ? 'answer' : 'question'
            ], $question);
        }

        // create answer, attach it to option
        $finalAnswer = ImportAnswer::import([
            'title' => $matches[$count - 1] . ' ' . ($option ? $option->text : null),
            'text' => nl2br($item[$count - 1])
        ], $option);
    }

    /**
     * importRowGetPoll
     */
    protected static function importRowGetPoll($loopindex)
    {
        if ($loopindex !== 0) {
            return;
        }

        if ($option_ids = request()->get('option_id')) {
            return;
        }

        return Poll::find(post('poll_id'));
    }

    /**
     * importRowGetOptions
     */
    protected static function importRowGetOptions($loopindex, $option)
    {
        if ($loopindex !== 0) {
            return collect()->push($option);
        }

        if (!$option_ids = request()->get('option_id')) {
            return;
        }

        return Option::whereIn('id', $option_ids)->get();
    }
}