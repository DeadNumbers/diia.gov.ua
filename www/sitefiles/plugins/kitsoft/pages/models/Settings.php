<?php namespace KitSoft\Pages\Models;

use KitSoft\Core\Classes\PluginHelpers;
use KitSoft\Pages\Behaviors\RelationFinderModel;
use KitSoft\Pages\Models\Page;
use Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = [
        '@KitSoft.MultiSite.Behaviors.MultiSiteSettingsModel',
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageSettingsModel',
        '@KitSoft.Revisions.Behaviors.RevisionsModel',
        'System.Behaviors.SettingsModel',
    ];

    // A unique code
    public $settingsCode = 'kitsoft_pages_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $rules = [];

    /**
     * getRelationFinderModels
     */
    public function getRelationFinderModels()
    {
        return PluginHelpers::getAllModels()->collapse()->filter(function ($item) {
            $model = $item::make();

            if (!$model->isClassExtendedWith('KitSoft.Pages.Behaviors.RelationFinderModel')) {
                return;
            }

            $config = $model->getRelationFinderConfig();
            $sluggable = $config['sluggable'] ?? true;

            return ($sluggable);
        })->sortBy(function ($item) {
            return last(explode('\\', $item));
        });
    }

    /**
     * getFieldConfig
     */
    public function getFieldConfig()
    {
        $models = $this->getRelationFinderModels();
        $fields = $this->makeConfig($this->settingsFields);

        foreach ($models as $model) {
            $fields->tabs['fields']["routes[{$model}]"] = [
                'emptyOption' => '-',
                'label' => last(explode('\\', $model)),
                'comment' => "<i>{$model}</i>",
                'commentHtml' => true,
                'type' => 'dropdown',
                'options' => Page::make()->getRouterOptions(),
                'span' => 'auto',
                'tab' => 'Routes'
            ];
        }

        return $fields;
    }

    /**
     * getRoutePageId
     */
    public static function getRoutePageId($model)
    {
        $routes = self::instance()->get('routes');

        return $routes[$model] ?? null;
    }

    /**
     * getConfiguredRelationFinderModels
     */
    public function getConfiguredRelationFinderModels()
    {
        return PluginHelpers::getModelsExtendedWith('KitSoft.Pages.Behaviors.RelationFinderModel')
            ->collapse()
            ->filter(function ($item) {
                $model = $item::make();

                if (isset($model->relationFinder['sluggable'])
                    && $model->relationFinder['sluggable'] === false
                ) {
                    return true;
                }

                return (isset($this->routes[$item]) && !empty($this->routes[$item]));
            })
            ->values();
    }
}
