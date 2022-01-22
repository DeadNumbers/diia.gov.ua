<?php
namespace KitSoft\Search\Classes;

use Carbon\Carbon;
use Config;
use Event;
use KitSoft\Search\Classes\Behavior\BaseElastic;
use KitSoft\Search\Classes\Helpers;
use KitSoft\Search\Models\Settings;
use Model;

class ElasticManager extends BaseElastic
{
    /**
     * key at elastic index
     * @var string
     */
    public $tagsKey = 'tag_slugs';
    
    public $categoriesKey = 'category_slugs';

    protected $dateFields;

    protected $removeHtml;

    protected $params;

    protected $mapping;

    protected $files;

    protected $dynamicAttributes;

    public function __construct(string $logPath = null)
    {
        parent::__construct($logPath);
        $this->dateFields = Config::get('kitsoft.search::elastic_settings.date_convert');
        $this->removeHtml = Config::get('kitsoft.search::elastic_settings.remove_html');
    }

    /**
     * set params by model field from config.php
     * @param string $className
     */
    public function setParamsByModel(string $className)
    {
        foreach ($this->providers as $key => $value) {
            if (class_basename($value['model']) !== class_basename($className)) {
                continue;
            }

            if (!$index = Helpers::getElasticIndex($key)) {
                return;
            }

            $this->params['index'] = $index;
            $this->mapping = $value['mappings'];
            $this->files = $value['files'] ?? [];
            $this->dynamicAttributes = $value['dynamicAttributes'] ?? [];
        }
        return $this;
    }

    /**
     * set params from array
     * @param array $data
     */
    public function setParamsFromArray(array $data)
    {
        $this->mapping = [
            'settings' => $data['settings'],
            'mappings' => [
                'properties' => $data['mappings']
            ]   
        ];
        $this->params['index'] = $data['index_name'];
        $this->files = $data['files'];
        $this->dynamicAttributes = $data['dynamicAttributes'];

        return $this;
    }

    public function createDocument(Model $model): void
    {
        $this->params['id'] = $model->id;
        $this->params['body'] = $this->filterColumns($model);
        $this->client->index($this->params);
    }

    public function updateOrCreateDocument(Model $model): void
    {
        $this->params['id'] = $model->id;
        $this->params['body']['doc'] = $this->filterColumns($model);
        $this->params['body']['doc_as_upsert'] = true;

        $this->client->update($this->params);
    }

    public function deleteDocument(int $docId): void
    {
        $this->params['id'] = $docId;
        $this->client->delete($this->params);
    }

    public function filterColumns(Model $model): array
    {
        $result = array_intersect_key($model->toArray(), $this->mapping);

        if ($model->isClassExtendedWith('KitSoft.Pages.Behaviors.RelationFinderModel')) {
            $result['url'] = $model->full_url;
        }

        if (array_key_exists($this->tagsKey, $this->mapping)){
            $result[$this->tagsKey] = implode(',', $model->tags->lists('slug'));
        }

        if (array_key_exists($this->categoriesKey, $this->mapping)){
            $result[$this->categoriesKey] = implode(',', $model->categories->lists('slug'));
        }

        foreach ($this->dateFields as $column) {
            if (!array_key_exists($column, $result)) continue;
            $result[$column] = Carbon::parse($result[$column])->toAtomString();
        }

        foreach ($this->mapping as $key => $row) {
            switch ($row['type']) {
                case 'boolean':
                    $result[$key] = (bool)$model->{$key};
                    break;
            }
        }

        foreach ($this->removeHtml as $column) {
            if (!array_key_exists($column, $result)) continue;
            $result[$column] = strip_tags($result[$column]);
        }

        foreach ($this->dynamicAttributes as $code => $attribute) {
            $result[$code] = object_get($model, $attribute);
        }

        // attach files
        $result = array_merge($result, Helpers::attachModelFiles($model, $this->files));

        $result['@timestamp'] = Carbon::now()->toAtomString();

        Event::fire('kitsoft.search::elasticsearch.manager.filterColumns', [$model, &$result]);

        return $result;
    }

    public function deleteAndCreateIndex(): void
    {
        if ($this->client->checkIndexExist(['index' => $this->params['index']])) {
            $this->client->deleteIndex(['index' => $this->params['index']]);
        }

        $this->client->createIndex(['index' => $this->params['index'], 'body' => $this->mapping]);

        //TODO: fix wrong mappings structure
        $this->mapping = $this->mapping['mappings']['properties'];
    }

    public function getModelFromProvider(string $type): string
    {
        return $this->providers[$type]['model'];
    }

    public function parseMappingFromIndexModel($mapping)
    {
        $result = json_decode($mapping, true);

        return $result['mappings']['properties'];
    }

    public static function make()
    {
        return new static();
    }
}