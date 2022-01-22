<?php namespace KitSoft\Forms\Components;

use Db;
use Exception;
use KitSoft\Forms\Classes\Exceptions\ValidatorBuilderException;
use KitSoft\Forms\Classes\ValidatorBuilderFactory;
use Validator;
use System\Models\File;
use ValidationException;
use Cms\Classes\ComponentBase;
use KitSoft\Forms\Models\Inbox;
use KitSoft\Forms\Models\Settings;
use KitSoft\Forms\Classes\MailSender;
use KitSoft\Forms\Models\Form as FormModel;
use Event as SystemEvent;

class Form extends ComponentBase
{
    use \System\Traits\ViewMaker;

    public $form;
    public $recaptcha;

    /**
     * componentDetails
     */
    public function componentDetails()
    {
        return [
            'name' => 'kitsoft.forms::lang.components.form.name',
            'description' => 'kitsoft.forms::lang.components.form.description'
        ];
    }

    /**
     * defineProperties
     */
    public function defineProperties()
    {
        return [
            'code' => [
                'title' => 'kitsoft.forms::lang.components.form.fields.code',
                'type' => 'dropdown',
                'options' => FormModel::get()->lists('code', 'code')
            ]
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->addJs('/plugins/kitsoft/forms/assets/js/forms-ajax.js');

        $this->form = $this->loadForm();
        $this->recaptcha = $this->loadRecaptcha();
    }

    /**
     * loadForm
     */
    protected function loadForm()
    {
        return FormModel::with('fields')
            ->where('code', $this->property('code'))
            ->first();
    }

    /**
     * loadRecaptcha
     */
    protected function loadRecaptcha()
    {
        return [
            'site_key' => Settings::get('site_key'),
            'lang' => Settings::get('lang')
        ];
    }

    /**
     * onSubmitForm
     */
    public function onSubmitForm()
    {
        $this->validateFormId();
        $this->form = FormModel::find(request()->get('form_id'));
        $this->validateFormFields();

        Db::beginTransaction();
        try {
            // save form data to db
            $inbox = Inbox::make();
            $inbox->form_id = request()->get('form_id');
            $inbox->fields = request()->only(
                $this->form->fields->lists('code')
            );
            $inbox->ip = request()->ip();
            $inbox->save();

            // attach files

            foreach ($this->form->fields as $field) {
                if ($field->type !== 'file') {
                    continue;
                }

                if ($file = request()->file($field->code)) {
                    $inbox->files()->add((new File())->fromPost($file));
                }
            }
        } catch (Exception $e) {
            Db::rollback();
            throw $e;
        }

        Db::commit();

        // send emails
        if ($this->form->send && count($this->form->emails)) {
            $sender = new MailSender($inbox);
            $sender->send();
        }

        $this->vars['inbox'] = $inbox;

        SystemEvent::fire('kitsoft.forms::inbox.afterSave', $inbox);
    }

    /**
     * validateFormId
     */
    protected function validateFormId()
    {
        $validator = Validator::make(
            request()->only(['form_id']),
            ['form_id' => 'required|exists:kitsoft_forms_forms,id']
        );
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * validateFormFields
     */
    protected function validateFormFields()
    {
        if (!$this->form) {
            throw new Exception('Form_id is not set.');
        }

        if (!count($this->form->fields)) {
            return;
        }

        // validate fields
        $validate_messages = [];
        foreach ($this->form->fields as $field) {
            if (!$field->validateRules || $field->type == 'recaptcha') {
                continue;
            }

            $validate_rules = $field->validateRules;
            if (is_array($validate_rules)) {
                $validate_replaces = [];
                foreach ($validate_rules as $key => $item) {
                    $data = array_get($field->rules_options, $item);
                    try {
                        $validate_replaces = array_merge(
                            (new ValidatorBuilderFactory)
                                ->factory($item)
                                ->build($data),
                            $validate_replaces
                        );
                        $validate_messages = array_merge(
                            (new ValidatorBuilderFactory)
                                ->factory($item)
                                ->messages(),
                            $validate_messages
                        );
                        unset($validate_rules[$key]);
                    } catch (ValidatorBuilderException $e) {
                    }
                }
                $validate_rules = array_merge($validate_rules, $validate_replaces);
            }
            $rules[$field->code] = $validate_rules;
        }

        $validator = Validator::make(
            request()->only($this->form->fields->lists( 'code')),
            $rules ?? [],
            $validate_messages,
            $this->form->fields->lists('title', 'code')
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // validate recaptcha after validate another fields, becouse it disposable
        foreach ($this->form->fields as $field) {
            if ($field->type !== 'recaptcha') {
                continue;
            }
            $validation = Validator::make(
                request()->only('g-recaptcha-response'),
                ['g-recaptcha-response' => 'required|recaptcha'],
                [],
                ['g-recaptcha-response' => $field->title]
            );
            if ($validation->fails()) {
                throw new ValidationException($validation);
            }
        }
    }
}
