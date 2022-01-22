<?php namespace KitSoft\Core\Updates;

use Backend\Models\UserPreference;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class SetDefaultWidgets extends Migration
{ 
    public function up() {
        UserPreference::make()->all()->each(function ($item) {

            // googleAnalytics
            if (!isset($item->value['googleAnalytics'])) {
                $item->value = array_merge($item->value, [
                    'googleAnalytics' => [
                        'class' => 'KitSoft\Core\ReportWidgets\GoogleAnalytics',
                        'sortOrder' => 10,
                        'configuration' => [
                            'ocWidgetWidth' => 5
                        ]
                    ]
                ]);
            }

            // robotsTxt
            if (!isset($item->value['robotsTxt'])) {
                $item->value = array_merge($item->value, [
                    'robotsTxt' => [
                        'class' => 'KitSoft\Core\ReportWidgets\RobotsTxt',
                        'sortOrder' => 9,
                        'configuration' => [
                            'ocWidgetWidth' => 5
                        ]
                    ]
                ]);
            }

            $item->save();
        });
    }
    
    public function down() {
        
    }
}