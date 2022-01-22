<?php namespace KitSoft\Forms\Models;

use Model;

/**
 * Field Model
 */
class Field extends Model
{
    use \October\Rain\Database\Traits\Sortable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_forms_fields';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $jsonable = ['options', 'rules', 'rules_options'];

    /**
     * @var \string[][]
     */
    protected $filtered_rules = [
        'limit' => ['text', 'textarea'],
        'required' => ['text', 'textarea', 'select', 'checkbox', 'multicheckbox', 'radio', 'file', 'phone']
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
     * getValidateRulesAttribute
     */
    public function getValidateRulesAttribute()
    {
        $rules = is_array($this->rules)
            ? $this->rules
            : [];

        switch ($this->type) {
            case 'multicheckbox':
                $rules = array_merge($rules, ['array']);
                break;
            case 'file':
                $rules = array_merge($rules, ['file']);
                if ($this->file_extensions) {
                    $rules = array_merge($rules, ['mimes:' . $this->file_extensions]);
                }
                break;
            case 'recaptcha':
            case 'label':
                $rules = [];
                break;
        }

        return $rules;
    }

    /**
     * Filter executed on backend action dependsOn
     * @param $fields
     * @param null $context
     */
    public function filterFields($fields, $context = null)
    {
        foreach ($this->filtered_rules as $key => $item) {
            $fields = $this->filterValidatesFields($fields, $item, $key);
        }
    }

    /**
     * @param $fields
     * @param $types
     * @param $validator
     * @return mixed
     */
    protected function filterValidatesFields($fields, $types, $validator)
    {
        if (isset($fields->type) &&
            !in_array($fields->type->value, $types)) {
            if ($fields->rules->value) {
                $fields->rules->value = collect($fields->rules->value)
                    ->filter(function ($item) use ($validator) {
                        return !in_array($item, [$validator]);
                    })->toArray();
            }
        }

        $this->filterValidateOptionsFields($validator, $fields,
            !in_array($validator, is_array($fields->rules->value ?? null) ? $fields->rules->value : []));

        return $fields;
    }

    /**
     * @param $checked_field
     * @param $fields
     * @return mixed
     */
    protected function filterValidateOptionsFields($checked_field, $fields, $hidden = true)
    {
        foreach ($fields as $key => $item) {
            if (isset($item->trigger['field']) &&
                strpos($item->trigger['field'], "rules[]") !== false &&
                strpos($item->trigger['condition'], "[$checked_field]") !== false
            ) {
                if($hidden) {
                    $fields->{$key}->value = '';
                }
                $fields->{$key}->hidden = $hidden;
            }
        }

        return $fields;
    }
}
