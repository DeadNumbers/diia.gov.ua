<?php namespace KitSoft\Pages\FormWidgets;

use ApplicationException;
use Backend\Classes\FormWidgetBase;
use KitSoft\Core\Classes\PluginHelpers;
use KitSoft\Pages\Twig\Filters;
use Model;

class RelationFinder extends FormWidgetBase
{
    public $models;
    public $recordsPerPage = 5;
    public $object;

    protected $defaultAlias = 'relationfinder';

    /**
     * init
     */
    public function init()
    {
        $this->fillFromConfig([
            'models',
            'recordsPerPage'
        ]);

        $this->object = self::getModelObject($this->getLoadValue());
    }

    /**
     * render
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('relationfinder');
    }

    /**
     * Prepares the widget data
     */
    public function prepareVars()
    {
        $this->vars['alias'] = $this->defaultAlias;

        $this->vars['model'] = $this->getValue('model');
        $this->vars['models'] = $this->getModelsOptions();
    }

    /**
     * getInputName
     */
    public function getInputName($name)
    {
        return $this->getFieldName() . "[{$name}]";
    }

    /**
     * getValue
     */
    public function getValue(string $param)
    {
        $value = $this->getLoadValue();
        return $value[$param] ?? null;
    }

    /**
     * getModels
     */
    protected function getModels()
    {
        return PluginHelpers::getAllModels()->collapse()->filter(function ($item) {
            if ($this->models && !in_array($item, $this->models)) {
                return;
            }

            return $item::make()->isClassExtendedWith('KitSoft.Pages.Behaviors.RelationFinderModel');
        });
    }

    /**
     * getModelsOptions
     */
    protected function getModelsOptions()
    {
        return $this->getModels()
            ->sortBy(function ($item) {
                return last(explode('\\', $item));
            })
            ->mapWithKeys(function ($item) {
                $class = '\\' . ltrim($item, '\\');

                $namespace = explode('\\', $item);

                switch (count($namespace)) {
                    case '4':
                        $name = "{$namespace[1]} - {$namespace[3]}";
                        break;
                    case '5':
                        $name = "{$namespace[2]} - {$namespace[4]}";
                        break;
                    
                    default:
                        $name = last($namespace);
                        break;
                }

                return [$class => $name];
            });
    }

    /**
     * onGetModelsOptions
     */
    public function onGetModelsOptions()
    {
        $model = post('model');
        $search = post('q');

        if (!array_key_exists($model, $this->getModelsOptions()->toArray())) {
            throw new ApplicationException("Wrong object type [{$model}]");
        }

        $model = $model::make();
        $config = $model->getRelationFinderConfig();
        $nameFrom = $config['nameFrom'] ?? 'title';
        $descriptionFrom = $config['descriptionFrom'] ?? null;

        $query = $model::where($nameFrom, 'ilike', "%{$search}%")
            ->orderBy($nameFrom, 'asc');

        switch (get_class($model)) {
            case 'KitSoft\Pages\Models\Page':
                $query = $query->isNotSluggable();
                break;
        }

        $results = $query->paginate($this->recordsPerPage);

        return [
            'result' => $results->mapWithKeys(function ($item) use ($nameFrom, $descriptionFrom) {
                $text = $descriptionFrom
                    ? $item->{$nameFrom} . ' ' . $item->{$descriptionFrom}
                    : $item->{$nameFrom};

                return [$item->id => $text];
            }),
            'pagination' => ['more' => $results->currentPage() < $results->lastPage()]
        ];
    }

    /**
     * getModelObject
     */
    public static function getModelObject($fields)
    {
        $type = (isset($fields, $fields['model']) && class_exists($fields['model']))
            ? 'object'
            : 'url';

        switch ($type) {
            case 'object':
                $result = (isset($fields['id']) && !empty($fields['id']))
                    ? $fields['model']::find($fields['id'])
                    : $fields['model']::make();
                if (!$result) {
                    $result = $fields['model']::make();
                }
                $result->relationFinderType = 'object';
                break;
            case 'url':
                $result = Model::make();
                $result->url = $fields['url'] ?? null;
                $result->title = $result->relationTitle = $fields['title'] ?? null;
                $result->target = $fields['target'] ?? null;
                $result->relationFinderType = 'url';
                break;            
        }

        return $result ?? null;
    }
}
