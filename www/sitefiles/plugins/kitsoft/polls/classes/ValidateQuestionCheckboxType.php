<?php namespace KitSoft\Polls\Classes;

use KitSoft\Polls\Models\Option;
use KitSoft\Polls\Models\Question;
use ValidationException;
use ApplicationException;

class ValidateQuestionCheckboxType
{

	/**
	 * question
	 */
	public static function question(Question $object)
	{
		if ($object->type !== 'checkbox') {
            return;
        }

        if (!$object->options->count()) {
            return;
        }

        $actions = $object->options->pluck('action')->unique();

        if ($actions->count() > 1) {
            throw new ValidationException([
            	'type' => trans('kitsoft.polls::lang.validate.different_actions')
            ]);
        }

        switch ($actions->first()) {
            case 'question':
                if ($object->options->pluck('question_id')->unique()->count() > 1) {
                    throw new ValidationException([
                    	'type' => trans('kitsoft.polls::lang.validate.different_questions')
                    ]);
                }
                break;
            case 'answer':
                if ($object->options->pluck('answer_id')->unique()->count() > 1) {
                    throw new ValidationException([
                    	'type' => trans('kitsoft.polls::lang.validate.different_answers')
                    ]);
                }
                break;
        }
	}

	/**
	 * option
	 */
	public static function option(Option $object)
	{
		if ($object->parent_questions->count() > 1) {
            throw new ApplicationException(trans('kitsoft.polls::lang.validate.parent_questions_count'));
        }

        if (!$question = $object->parent_questions->first()) {
        	$question = Question::findOrFail(post('_parent_question_id'));
        }

        if ($question->type !== 'checkbox') {
            return;
        }

        $question->options->where('id', '<>', $object->id)->each(function ($item) use ($object) {
        	if ($item->action != $object->action) {
        		throw new ValidationException([
        			'type' => trans('kitsoft.polls::lang.validate.different_actions')
        		]);
        	}
        	switch ($item->action) {
        		case 'question':
        			if ($item->question_id != $object->question_id) {
        				throw new ValidationException([
	                    	'type' => trans('kitsoft.polls::lang.validate.different_questions')
	                    ]);
        			}
        			break;
        		case 'answer':
        			if ($item->answer_id != $object->answer_id) {
        				throw new ValidationException([
	                    	'type' => trans('kitsoft.polls::lang.validate.different_answers')
	                    ]);
        			}
        			break;
        	}
        });
	}
}
