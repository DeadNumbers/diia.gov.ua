<?php namespace KitSoft\Pages\Classes;

use October\Rain\Html\Helper as HtmlHelper;

class ValidationHelpers
{
	/**
     * getRulesFromFields
     */
    public static function getRulesFromFields(array $fields, array $prefix = []) {
        $result = [];

        foreach ($fields as $key => $row) {
            $fieldPath = array_merge($prefix, HtmlHelper::nameToArray($key));

            if (array_has($row, 'rules')) {
                $result[implode('.', $fieldPath)] = $row['rules'];
            }

            $type = $row['type'] ?? null;

            switch ($type) {
                case 'repeater':
                    // add * to field path to validate every field
                    $fieldPath[] = '*';
                    $repeaterFields = $row['form']['fields'] ?? [];
                    if ($repeaterRules = self::getRulesFromFields($repeaterFields, $fieldPath)) {
                        $result = array_merge($result, $repeaterRules);
                    }
                    break;
            }            
        }

        return $result;
    }
}