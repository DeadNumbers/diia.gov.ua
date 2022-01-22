<?php
namespace KitSoft\Search\Classes\Behavior;

use App;
use Config;
use Illuminate\Http\Request;
use KitSoft\Search\Classes\Helpers;

/**
* elastic abstract
*/
abstract class BaseElastic
{
    protected $providers;

    protected $client;

    public function __construct()
    {
        $this->client = App::make('KitSoft\Search\Classes\Interfaces\ElasticClientContract');
        $this->providers = Helpers::getProviders();
    }
}