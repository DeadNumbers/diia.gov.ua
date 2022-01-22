<?php namespace KitSoft\Pages\Classes;

class RelationField
{
	/**
     * setFieldsOptions recursive
     */
    public static function setFieldsOptions($fields)
    {
        foreach ($fields as $key => &$row) {
            if (!is_array($row)) {
                continue;
            }

            if (isset($row['type'], $row['relation'])) {
                switch ($row['type']) {
                    case 'dropdown':
                        $row['options'] = $row['relation']['model']::lists($row['relation']['value'], $row['relation']['key']);
                        break;
                }
            }

            $row = self::setFieldsOptions($row);
        }

        return $fields;
    }
}
