<?php namespace KitSoft\Forms\Models;

use Model;
use ApplicationException;
use KitSoft\Forms\Models\Field;
use System\Models\MailTemplate;
use \October\Rain\Database\Traits\Validation;

/**
 * Form Model
 */
class Form extends Model
{
    use Validation;

    public $implement = [
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel'
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'code' => 'required'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_forms_forms';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $jsonable = ['emails'];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'fields' => [Field::class,
            'delete' => true
        ]
    ];
    public $belongsTo = [
        'template' => [MailTemplate::class]
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * filterFields
     */
    public function filterFields($fields, $context = null)
    {
        if ($context == 'update' && $this->is_system) {
            $fields->code->disabled = true;
        }
    }

    /**
     * delete
     */
    public function delete()
    {
        if ($this->is_system) {
            throw new ApplicationException('Не можливо видалити системну форму.');
        }

        if (Inbox::where('form_id', $this->id)->first()) {
            throw new ApplicationException('Серед обраних форм, є ті, що мають вхідні листи. Видаліть спочатку листи.');
        }

        parent::delete();
    }
}
