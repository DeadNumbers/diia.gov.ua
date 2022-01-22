<?php namespace KitSoft\Polls\Components;

use Cms\Classes\ComponentBase;
use Crypt;
use Exception;
use KitSoft\Polls\Classes\ValidatePollForm;
use KitSoft\Polls\Models\Department;
use KitSoft\Polls\Models\Location;
use KitSoft\Polls\Models\Log;
use KitSoft\Polls\Models\Option;
use KitSoft\Polls\Models\Poll as PollModel;
use ValidationException;
use Validator;

class Poll extends ComponentBase
{
    public $poll;
    public $option;
    public $step;
    public $department;
    public $departments;
    public $location;
    public $locations;
    public $log;

    public function componentDetails()
    {
        return [
            'name'        => 'Poll',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'poll' => [
                'title' => 'Опитування',
                'type' => 'dropdown',
                'emptyOption' => '-',
                'options' => PollModel::lists('title', 'id')
            ]
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->step = 1;
        $this->log = Crypt::encrypt([]);
        $this->poll = $this->loadPoll();
    }

    /**
     * loadPoll
     */
    protected function loadPoll()
    {
        return PollModel::find($this->property('poll'));
    }

    /**
     * onPollLoad
     */
    public function onPollLoad()
    {
        $this->onRun();
    }

    /**
     * onAnswerPoll
     */
    public function onAnswerPoll()
    {
        $data = request()->all();

        ValidatePollForm::run($data);

        try {
            $options = Option::find($data['option_ids']);

            $log = Crypt::decrypt($data['log']);
            $log['options'] = array_merge(
                array_get($log, 'options', []),
                $options->lists('id')
            );
            $log['comments'] = array_get($log, 'comments', []) + array_get($data, 'comments', []);

            $this->log = Crypt::encrypt($log);
            $this->option = $options->first();
            $this->poll = $this->loadPoll();
            $this->locations = Location::get();
            $this->step = ++$data['step'];

            if ($this->option->is_last) {
                Log::store($this->poll, $log);
                Option::whereIn('id', $log['options'])->get()->each(function ($item) {
                    $item->increment('votes');
                    $item->logs()->create();
                });
            }
        } catch (Exception $e) {
            trace_log($e);
            return response()
                ->json('Something was wrong.', 500);
        }
    }

    /**
     * onLoadDepartments
     */
    public function onLoadDepartments()
    {
        $data = request()->all();

        $validator = Validator::make($data, [
            'location' => 'required|exists:kitsoft_polls_locations,slug',
            'answer_id' => 'required|exists:kitsoft_polls_answers,id'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            $this->departments = Department::make()
                ->whereHas('locations', function ($query) use ($data) {
                    return $query->where('slug', $data['location']);
                })
                ->whereHas('answers', function ($query) use ($data) {
                    return $query->where('id', $data['answer_id']);
                })
                ->get();
        } catch (Exception $e) {
            trace_log($e);
            return response()
                ->json('Something was wrong.', 500);
        }
    }

    /**
     * onDepartment
     */
    public function onDepartment()
    {
        $data = request()->all();

        $validator = Validator::make($data, [
            'department' => 'required|exists:kitsoft_polls_departments,slug',
            'location' => 'required|exists:kitsoft_polls_locations,slug'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            $this->department = Department::where('slug', $data['department'])->first();
            $this->location = Location::where('slug', $data['location'])->first();
        } catch (Exception $e) {
            trace_log($e);
            return response()
                ->json('Something was wrong.', 500);
        }
    }
}
