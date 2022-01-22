<?php namespace KitSoft\MultiLanguage\Classes;

use Db;

class Validators
{
    /**
     * Slug must be unique, but exclude entities models slugs
     */
    public function uniqueTranlated($attribute, $value, $parameters)
    {
        $model = new $parameters[0]();

        $query = $model::where($attribute, $value);

        if($id = $parameters[1] ?? null) {
            $query = $query->where('id', '<>', $id);
        }

        return $query->count()
            ? false
            : true;
    }

    /**
     * Error message
     */
    public function uniqueTranlatedMessage($message, $attribute, $rule, $parameters)
    {
        return trans('kitsoft.multilanguage::lang.validators.slug_exist');
    }
}
