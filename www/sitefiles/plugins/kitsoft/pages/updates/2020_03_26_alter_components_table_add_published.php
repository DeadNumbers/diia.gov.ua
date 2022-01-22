<?php namespace KitSoft\Pages\Updates;

use Db;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AlterComponentsTableAddPublished extends Migration
{
    public function up()
    {
        Db::update("UPDATE kitsoft_pages_components SET published = true");
    }

    public function down()
    {
        
    }
}