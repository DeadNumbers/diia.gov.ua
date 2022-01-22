<?php namespace KitSoft\Revisions\Classes;

use KitSoft\Revisions\Classes\DiffValue;

class Diff
{
    /**
     * diff
     */
    public static function diff($old, $new)
    {
        if (is_array($old) || is_array($new)) {
            return self::diffArray($old, $new);
        }

        return array_first(self::diffArray([$old], [$new]));
    }

    /**
     * diff
     */
    public static function diffArray($old, $new)
    {
        $diff = [];
        
        if ($old == $new) {
            return $diff;
        }
        
        $old = is_array($old) ? $old : [];
        $new = is_array($new) ? $new : [];

        foreach ($old as $key => $value) {
            if (!isset($new[$key]) || empty($new[$key])) {
                if (!is_null($value) && !empty($value)) {
                    $diff[$key] = self::singular(DiffValue::TYPE_REMOVED, $value);
                }
                continue;
            }
            
            $valueNew = $new[$key];
            
            if (is_array($valueNew)) {
                $temp = self::diffArray($value, $valueNew);
                
                if (!empty($temp)) {
                    $diff[$key] = $temp;
                }
                
                continue;
            }
            
            if ($value != $valueNew) {
                $diff[$key] = new DiffValue(DiffValue::TYPE_MODIFIED, $value, $valueNew);
            }
        }
        
        foreach ($new as $key => $value) {
            if ((!isset($old[$key]) || empty($old[$key])) && (!is_null($value) && !empty($value))) {
                $diff[$key] = self::singular(DiffValue::TYPE_ADDED, $value);
            }
        }
        
        return $diff;
    }

    /**
     * singular
     */
    private static function singular($type, $value)
    {
        if (is_array($value)) {
            $diff = [];
            
            foreach ($value as $key => $value2) {
                $diff[$key] = self::singular($type, $value2);
            }
            
            return $diff;
        }
        
        if ($type === DiffValue::TYPE_REMOVED) {
            return new DiffValue($type, $value, null);
        }
        
        return new DiffValue($type, null, $value);
    }

    /**
     * filterValue
     */
    public static function filterValue($data, string $key)
    {
        if (!$data) {
            return;
        }

        if ($data instanceof DiffValue) {
            return $data->{$key};
        }

        foreach ($data as &$row) {
            if ($row instanceof DiffValue) {
                $row = $row->{$key};
            } else {
                $row = self::filterValue($row, $key);
            }
        }

        return $data;
    }
}
