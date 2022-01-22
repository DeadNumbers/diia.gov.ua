<?php
namespace KitSoft\Core\Updates;

use Kitsoft\Core\Models\RobotsTxt;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class setRobotsTxtSettings extends Migration
{ 
    public function up() {
        $settings = RobotsTxt::instance();
        $settings->status = 0;
        if (env('APP_ENV') != 'prod') {
            $settings->code = "User-agent: *\r\nDisallow: /";
        } else {
            $settings->code = "User-agent: *\r\nDisallow:";
        }
        $settings->save();
    }
    
    public function down() {
        
    }
}