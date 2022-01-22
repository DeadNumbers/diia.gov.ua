<?php namespace KitSoft\Sitemap\Models;

use KitSoft\Core\Classes\PluginHelpers;
use Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    public $implement = [
        '@KitSoft.Revisions.Behaviors.RevisionsModel',
        'System.Behaviors.SettingsModel',
    ];

    // A unique code
    public $settingsCode = 'kitsoft_sitemap_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    /**
     * getPriority
     */
    public function getPriority($model)
    {
        $data = $this->get('priority');

        return $data[$model] ?? '0.5';
    }

    /**
     * getChangefreq
     */
    public function getChangefreq($model)
    {
        $data = $this->get('changefreq');

        return $data[$model] ?? 'daily';
    }

    /**
     * getFieldConfig
     */
    public function getFieldConfig()
    {
        $models = PluginHelpers::getModelsExtendedWith('KitSoft.Pages.Behaviors.RelationFinderModel')
            ->collapse();

        $fields = $this->makeConfig($this->settingsFields);

        foreach ($models as $model) {
            $fields->tabs['fields']["priority[{$model}]"] = [
                'emptyOption' => '-',
                'label' => last(explode('\\', $model)),
                'comment' => "<i>{$model}<br>default: 0.5</i>",
                'commentHtml' => true,
                'type' => 'dropdown',
                'options' => [
                	'0.1' => '0.1',
                	'0.2' => '0.2',
                	'0.3' => '0.3',
                	'0.4' => '0.4',
                	'0.5' => '0.5',
                	'0.6' => '0.6',
                	'0.7' => '0.7',
                	'0.8' => '0.8',
                	'0.9' => '0.9',
                	'1.0' => '1.0'
                ],
                'default' => '0.5',
                'span' => 'auto',
                'tab' => 'Priorities'
            ];

            $fields->tabs['fields']["changefreq[{$model}]"] = [
                'emptyOption' => '-',
                'label' => last(explode('\\', $model)),
                'comment' => "<i>{$model}<br>default: daily</i>",
                'commentHtml' => true,
                'type' => 'dropdown',
                'options' => [
                	'always' => 'always',
                	'hourly' => 'hourly',
                	'daily' => 'daily',
                	'weekly' => 'weekly',
                	'monthly' => 'monthly',
                	'yearly' => 'yearly',
                	'never' => 'never',
                ],
                'default' => 'daily',
                'span' => 'auto',
                'tab' => 'Changefreq'
            ];
        }

        return $fields;
    }
}
