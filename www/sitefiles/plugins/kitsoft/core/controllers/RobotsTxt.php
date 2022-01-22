<?php namespace Kitsoft\Core\Controllers;

use Event;
use Illuminate\Http\Response;
use KitSoft\Core\Classes\RobotsTxtHelpers;

/**
 * RobotsTxt Controller
 */
class RobotsTxt
{
    /**
     * index
     */
    public function index(): Response
    {
        $response = RobotsTxtHelpers::getRobotsContent();

        Event::fire('kitsoft.core::extendRobotsTxt', [&$response]);

        return response($response)
            ->header('Content-Type', 'text/plain');
    }
}
