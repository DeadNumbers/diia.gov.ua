<?php namespace KitSoft\Pages\Traits;

use Exception;

trait Sluggable
{
    protected $sluggableSeparator = '-';

    /**
     * bootSluggable
     */
    public static function bootSluggable()
    {
        if (!property_exists(get_called_class(), 'slugs')) {
            throw new Exception('You must define a $slugs property to use the Sluggable trait.');
        }

        static::extend(function($model) {
            $model->bindEvent('model.beforeSave', function() use ($model) {
                $model->setSluggableAttributes();
            });
        });
    }

    /**
     * setSluggableAttributes
     */
    protected function setSluggableAttributes()
    {
        foreach ($this->slugs as $field => $maxLength) {
            if (!isset($this->{$field})) {
                continue;
            }
            $this->{$field} = $this->setSluggableField($field, $this->{$field}, $maxLength);
        }
    }

    /**
     * setSluggableField
     */
    protected function setSluggableField($field, $value, $maxLength)
    {
        $counter = 1;
        $_value = $value = str_limit($value, $maxLength, '');

        while ($this->newSluggableQuery()->where($field, $_value)->count() > 0) {
            $counter++;
            $strLimit = $maxLength - strlen($counter) - strlen($this->sluggableSeparator);
            $_value = str_limit($value, $strLimit, '') . $this->sluggableSeparator . $counter;
        }

        return $_value;
    }


    /**
     * newSluggableQuery
     */
    protected function newSluggableQuery()
    {
        return $this->exists
            ? $this->newQuery()->where($this->getKeyName(), '<>', $this->getKey())
            : $this->newQuery();
    }
}
