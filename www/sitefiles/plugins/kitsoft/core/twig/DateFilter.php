<?php namespace KitSoft\Core\Twig;

class DateFilter
{
	/**
     * diffForHumans
     */
    public static function diffForHumans($date) {
        return $date ? str_replace('назад', 'тому', $date->diffForHumans()) : null;
    }
}