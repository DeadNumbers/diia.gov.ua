<?php namespace KitSoft\Forms\Models;

use KitSoft\Forms\Models\Form;
use Model;
use October\Rain\Argon\Argon;

/**
 * Inbox Model
 */
class Inbox extends Model
{
    public $implement = [
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_forms_inbox';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $jsonable = ['fields'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'form' => [Form::class]
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [
        'files' => 'System\Models\File'
    ];

    /**
     * getStatusOptions
     */
    public function getStatusOptions()
    {
        return [
            'new'     => trans('kitsoft.forms::lang.inbox.statuses.new'),
            'process' => trans('kitsoft.forms::lang.inbox.statuses.process'),
            'closed'  => trans('kitsoft.forms::lang.inbox.statuses.closed')
        ];
    }

    /**
     * isClosed
     */
    public function isClosed()
    {
        return ($this->status == 'closed');
    }

    /**
     * getStatusLabelAttribute
     */
    public function getStatusLabelAttribute()
    {
        return $this->getStatusOptions()[$this->status] ?? '-';
    }

    /**
     * scopeUnreaded
     */
    public function scopeUnreaded($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * getUnreadedInboxCount
     */
    public static function getUnreadedInboxCount($formCode = null)
    {
        if ($formCode) {
            return self::unreaded()->whereHas('form', function ($query) use ($formCode) {
                return $query->where('code', $formCode);
            })->count();
        }

        return self::unreaded()->count();
    }

    /**
     * scopeFilterDates
     */
    public function scopeFilterDates($query, $date_from, $date_to)
    {
        if ($date_from) {
            $query->where([
                ['created_at', '>=', Argon::parse($date_from)],
                ['created_at', '<=', Argon::parse($date_to)->setTime(23, 59, 59)]
            ]);
        } else {
            $query->where('created_at', '<=', Argon::parse($date_to)->setTime(23, 59, 59));
        }

        return  $query;
    }

    /**
     * getFieldsStringAttribute
     */
    public function getFieldsStringAttribute()
    {
        return collect($this->fields)
            ->transform(function ($value, $key) {
                if (is_array($value)) {
                    $value = implode(', ', $value);
                }
                if (!$this->form) {
                    return "{$key}={$value}";
                }
                if (!$field = $this->form()->first()->fields->where('code', $key)->first()) {
                    return "{$key}={$value}";
                }
                return "{$field->title}={$value}";
            })
            ->implode("\r");
    }
}
