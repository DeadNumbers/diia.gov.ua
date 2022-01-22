<?php

namespace KitSoft\Forms\Classes;

use KitSoft\Forms\Classes\Exceptions\ValidatorBuilderException;
use KitSoft\Forms\Classes\Validatorbuilders\BuilderLimit;

class ValidatorBuilderFactory
{
    /**
     * @param $rule
     * @return BuilderLimit
     * @throws ValidatorBuilderException
     */
    public static function factory($rule)
    {
        switch ($rule) {
            case 'limit':
                $builder = new BuilderLimit();
                break;
            default:
                throw new ValidatorBuilderException('Validator builder not found');
        }

        return $builder;
    }
}
