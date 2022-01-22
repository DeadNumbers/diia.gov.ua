<?php namespace KitSoft\Pages\Extensions;

use KitSoft\Pages\Models\Page;
use Validator;

class ValidatorsExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
        Validator::extend('nestedUnique', 'KitSoft\Pages\Extensions\ValidatorsExtension@uniqueNested');
        Validator::replacer('nestedUnique', 'KitSoft\Pages\Extensions\ValidatorsExtension@uniqueNestedMessage');

        Validator::extend('different_symbols', 'KitSoft\Pages\Extensions\ValidatorsExtension@differentSymbols');
        Validator::replacer('different_symbols', 'KitSoft\Pages\Extensions\ValidatorsExtension@differentSymbolsMessage');
    }

    /**
     * Page must be unique by attribute in tree
     */
    public function uniqueNested($attribute, $value, $parameters, $validator)
    {
        $data = $validator->getData();

        $query = Page::where('slug', $data['slug']);

        $query = !empty($data['parent_id'])
            ? $query->where('parent_id', $data['parent_id'])
            : $query->whereNull('parent_id');

        $query = isset($data['id'])
            ? $query->where('id', '<>', $data['id'])
            : $query;

        return $query->count()
            ? false
            : true;
    }

    /**
     * Error message
     */
    public function uniqueNestedMessage($message, $attribute, $rule, $parameters)
    {
        return 'Cторінка з таким посиланням вже існує.';
    }

    /**
     * differentSymbols
     */
    public function differentSymbols($attribute, $value, $parameters, $validator)
    {
        $count = array_first($parameters) ?? 2;
        $symbols = array_unique(str_split($value));

        return (count($symbols) >= $count);
    }

    /**
     * differentSymbolsMessage
     */
    public function differentSymbolsMessage($message, $attribute, $rule, $parameters)
    {
        $count = array_first($parameters) ?? 2;

        return "Пароль має містити не менше {$count} різних символів";
    }
}
