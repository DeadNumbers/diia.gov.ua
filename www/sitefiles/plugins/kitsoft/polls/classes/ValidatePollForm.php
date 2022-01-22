<?php namespace KitSoft\Polls\Classes;

use KitSoft\Polls\Models\Option;
use ValidationException;
use Validator;

class ValidatePollForm
{
	/**
	 * run
	 */
	public static function run(array $data): void
	{
		$validator = Validator::make($data, [
            'option_ids' => 'required|array',
            'option_ids.*' => 'required|int|exists:kitsoft_polls_options,id',
            'comments' => 'array',
            'comments.*' => 'string',
            'step' => 'required|integer',
            'log' => 'required|string'
        ], [], ['option_ids' => '']);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        Option::findOrFail($data['option_ids'])->each(function ($item) use ($data) {
        	if (!$item->comment) {
        		return;
        	}

        	if (!$item->comment_is_required) {
        		return;
        	}

        	if (array_get($data, "comments.{$item->id}")) {
        		return;
        	}

        	throw new ValidationException(['comments.*' => trans('system::validation.required', [
                'attribute' => null
            ])]);
        });
	}
}
