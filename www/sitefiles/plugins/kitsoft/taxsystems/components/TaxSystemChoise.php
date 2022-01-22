<?php namespace KitSoft\TaxSystems\Components;

use Cms\Classes\ComponentBase;
use Exception;
use KitSoft\TaxSystems\Models\EntrepreneurQuestion;
use KitSoft\TaxSystems\Models\TaxSystem;
use ValidationException;
use Validator;

class TaxSystemChoise extends ComponentBase
{
    public $questions;

    public function componentDetails()
    {
        return [
            'name'        => 'Choise Tax System',
            'description' => ''
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->questions = $this->loadEntrepreneurQuestions();
    }

    /**
     * loadEntrepreneurQuestions
     */
    protected function loadEntrepreneurQuestions()
    {
        return EntrepreneurQuestion::isPublished()
            ->with(['entrepreneur_options' => function ($query) {
                return $query->isPublished();
            }])
            ->get();
    }

    /**
     * onChoiseTaxSystem
     */
    public function onChoiseTaxSystem()
    {
        $this->validateChoisedOptions();

        try {
            // get selected options list for any qeustion
            $optionsList = $this->getChoisedOptions();

            // get same tax system or default by options list
            if (!$taxSystem = TaxSystem::findByOptionsList($optionsList)) {
                return response()->json('Not find any tax system.', 406);
            }
        } catch (Exception $e) {
            trace_log($e);
            return response()->json('Something was wrong.', 500);
        }

        return redirect()->to("{$taxSystem->url}?choise=true");
    }

    /**
     * validateChoisedOptions
     */
    protected function validateChoisedOptions(): void
    {
        $questions = $this->loadEntrepreneurQuestions()
            ->where('is_required', true)
            ->whereIn('id', request()->get('questions') ?? []);

        $data = request()->all();
        
        $rules = $questions
            ->mapWithKeys(function ($item): array {
                $options = $item->entrepreneur_options->implode('id', ',');

                switch ($item->type) {
                    case 'select':
                    case 'radio':
                        return [
                            $item->input_name => "required|in:{$options}"
                        ];
                    
                    case 'checkbox':
                        return [
                            $item->input_name => 'required|array',
                            $item->input_name . '*' => "required|in:{$options}"
                        ];
                }

                return [];
            })
            ->toArray();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * getChoisedOptions
     */
    protected function getChoisedOptions(): array
    {
        return $this->loadEntrepreneurQuestions()
            ->transform(function ($item) {
                return request()->get($item->input_name);
            })
            ->flatten()
            ->filter()
            ->toArray();
    }
}
