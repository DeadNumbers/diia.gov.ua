<?php namespace KitSoft\Revisions\Classes;

use Illuminate\Database\Eloquent\Model;
use KitSoft\Pages\Models\Component;
use KitSoft\Pages\Models\Menu;
use KitSoft\Pages\Models\MenuItem;
use KitSoft\Pages\Models\Page;
use KitSoft\Pages\Models\Section;

class Helpers
{
    use \System\Traits\ConfigMaker;

    /**
     * getConfigByModel
     */
    public static function getConfigByModel(Model $model)
    {
        $segments = explode('\\', get_class($model));
        $plugin = strtolower($segments[0] . '.' . $segments[1]);

        return config("{$plugin}::revisions");
    }

    /**
     * getModelConfigFields
     */
    public static function getModelConfigFields(string $model): array
    {
        $object = new self();

        $configPath = str_replace('\\', '/', strtolower($model));
        
        $config = $object->makeConfig("$/{$configPath}/fields.yaml");

        return array_merge(
            $config->fields ?? [],
            $config->tabs['fields'] ?? [],
            $config->secondaryTabs['fields'] ?? []
        );
    }

    /**
     * getModelFieldLabel
     */
    public static function getModelFieldLabel($model, $field): string
    {
        if (!$field) {
            return '';
        }

        $fields = self::getModelConfigFields($model);

        return isset($fields[$field], $fields[$field]['label'])
            ? trans($fields[$field]['label'])
            : $field;
    }

    /**
     * getRevisionGroup
     */
    public static function getRevisionGroup(Model $model): string
    {
        switch (get_class($model)) {
            // hack for create context, it works only when edit component on popup in page editor
            case Section::class:
            case Component::class:
                if ($entity = $model->entity()) {
                    return self::generateGroupName(Page::class, $entity->page_id);
                }                
            case MenuItem::class:
                if ($model->menu_id) {
                    return self::generateGroupName(Menu::class, $model->menu_id);
                }
        }

        return self::generateGroupName($model, $model->id);
    }

    /**
     * generateGroupName
     */
    public static function generateGroupName($model, int $modelId): string
    {
        $modelClass = is_string($model)
            ? $model
            : get_class($model);

        return $modelClass . '::' . $modelId;
    }

    /**
     * isJson
     */
    public static function isJson($data)
    {
        if (is_array($data)) {
            return false;
        }
        json_decode($data);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
