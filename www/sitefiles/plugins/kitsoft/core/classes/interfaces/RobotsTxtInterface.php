<?php namespace KitSoft\Core\Classes\Interfaces;

interface RobotsTxtInterface
{
    public static function getCacheKey(): string;
    public static function getRobotsContent(): string;
}
