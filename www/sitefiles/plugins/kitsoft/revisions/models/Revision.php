<?php namespace KitSoft\Revisions\Models;

use KitSoft\Pages\Models\Component;
use KitSoft\Pages\Models\Partial;
use KitSoft\Pages\Models\Section;
use KitSoft\Revisions\Classes\Diff;
use KitSoft\Revisions\Classes\Helpers;
use Model;

/**
 * Revision Model
 */
class Revision extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'system_revisions';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'user' => ['Backend\Models\User']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * getOldValueAttribute
     */
    public function getOldValueAttribute($value)
    {
        return ($this->cast == 'json')
            ? json_decode($value, true)
            : $value;
    }

    /**
     * getNewValueAttribute
     */
    public function getNewValueAttribute($value)
    {
        return ($this->cast == 'json')
            ? json_decode($value, true)
            : $value;
    }

    /**
     * getOldValueDiffAttribute
     */
    public function getOldValueDiffAttribute() {
        return Diff::filterValue($this->diff, 'oldValueDiff');
    }

    /**
     * getNewValueDiffAttribute
     */
    public function getNewValueDiffAttribute() {
        return Diff::filterValue($this->diff, 'newValueDiff');
    }

    /**
     * getDiffAttribute
     */
    public function getDiffAttribute() {
        return Diff::diff(
            $this->old_value,
            $this->new_value
        );
    }

    /**
     * getRevisionableTypeOptions
     */
    public function getRevisionableTypeOptions() {
        return self::select('revisionable_type')
            ->orderBy('revisionable_type')
            ->groupBy('revisionable_type')
            ->lists('revisionable_type', 'revisionable_type');
    }

    /**
     * getTypeAttribute
     */
    public function getTypeAttribute($value)
    {
        switch ($this->revisionable_type) {
            case 'KitSoft\Pages\Models\Section':
                $string = 'Секція';
                break;
            case 'KitSoft\Pages\Models\Page':
                $string = 'Сторінка';
                break;
            case 'KitSoft\Pages\Models\Component':
                $string = 'Компонента';
                break;
            case 'KitSoft\Pages\Models\Partial':
                $string = 'Секція';
                break;
            case 'KitSoft\Pages\Models\Menu':
                $string = 'Меню';
                break;
            case 'KitSoft\Pages\Models\MenuItem':
                $string = 'Пункт меню';
                break;
            default:
                $string = class_basename($this->revisionable_type);
                break;
        }

        return $string . ($this->title ? ": {$this->title}" : null);
    }

    /**
     * getTitleAttribute
     */
    public function getTitleAttribute($value)
    {
        $string = '';

        switch ($this->revisionable_type) {
            case 'KitSoft\Pages\Models\Section':
            case 'KitSoft\Pages\Models\Component':
                $string .= $this->object
                    ? $this->object->name
                    : '';
                $string .= ' [ID: ' . $this->revisionable_id . ']';
                break;
            case 'KitSoft\Pages\Models\MenuItem':
                $string .= $this->object
                    ? $this->object->title
                    : '';
                break;
        }

        return $string;
    }

    /**
     * getObjectAttribute
     */
    public function getObjectAttribute($value)
    {
        return $this->revisionable_type::find($this->revisionable_id);
    }

    /**
     * getFieldTitleAttribute
     */
    public function getFieldTitleAttribute()
    {
        return Helpers::getModelFieldLabel($this->revisionable_type, $this->field);
    }

    /**
     * getUserLoginAttribute
     */
    public function getUserLoginAttribute()
    {
        return $this->user
            ? $this->user->login
            : '<i>system</i>';
    }

    /**
     * renderField
     */
    public function renderField($field, $array = null)
    {
        if (!is_array($this->$field)) {
            return $this->$field;
        }
        $array = $array ?? $this->$field;

        echo '<ul>';
        foreach ($array as $key => $value) {
            $value = Helpers::isJson($value) ? json_decode($value, true) : $value;
            if (is_array($value)) {
                echo "<li><i>{$key}</i></li>";
                $this->renderField($field, $value);
            } else {
                echo "<li><i>{$key}</i>: {$value}</li>";
            }
        }
        echo '</ul>';
    }
}
