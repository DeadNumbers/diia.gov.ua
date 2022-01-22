<?php
namespace KitSoft\Search\Jobs;

use DB;
use Exception;
use KitSoft\Search\Classes\ElasticManager;
use KitSoft\Search\Classes\Traits\HelperTrait;

/**
* elastic index manager
* rebuild, build index
*/
class ElasticRebuild
{
    protected $manager;

    public function __construct()
    {
        $this->manager = ElasticManager::make();
    }

    /**
     * fire job for elastic rebuild
     * @param  $job  current job
     * @param  array $data
     * @return void
     */
    public function fire($job, array $data)
    {
        DB::connection()->disableQueryLog();

        $model = $this->manager->getModelFromProvider($data['type']);
        if (!class_exists($model)) {
            trace_log("{$model} doesn`t exist. ".class_basename($this));
        }

        $this->prepareJob($data);
        $this->startProcess($model, $data);

        $job->delete();
    }

    protected function prepareJob(array $data): void
    {
        $this->manager->setParamsFromArray($data)->deleteAndCreateIndex();
    }

    protected function startProcess(string $model, array $data): void
    {
        $model = $model::make();
        $query = $model::withoutGlobalScopes()
            ->orderBy('created_at', 'desc');

        // filter by language
        if ($model->hasRelation('lang') && isset($data['lang'])) {
            $query = $query->trans($data['lang']);
        }

        if ($model->hasRelation('tags')) {
            $query = $query->with('tags');
        }

        $query->chunk(200, function ($items) {
            $items->each(function ($item) {
                try {
                    $this->manager->createDocument($item);
                } catch (Exception $e) {
                    trace_log(class_basename($this) . ' ' . $e->getMessage());
                }
            });
        });
    }
}
