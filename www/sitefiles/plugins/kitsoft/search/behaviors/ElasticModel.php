<?php namespace KitSoft\Search\Behaviors;

use KitSoft\Search\Classes\ElasticManager;
use KitSoft\Search\Classes\Traits\HelperTrait;
use October\Rain\Extension\ExtensionBase;
use Exception;

class ElasticModel extends ExtensionBase
{
    protected $model;
    
    public function __construct($model)
    {
        $this->model = $model;

        $this->model->bindEvent('model.afterSave', function () {
            $this->afterSave();
        });

        $this->model->bindEvent('model.afterDelete', function () {
            $this->afterDelete();
        });
    }

    protected function afterSave(): void
    {
        try {
            $sessionKey = post('_session_key');

            foreach ($this->model->attachOne as $key => $row) {
                $this->model->{$key} = $this->model->{$key}()
                    ->withDeferred($sessionKey)
                    ->first();
            }

            foreach ($this->model->attachMany as $key => $row) {
                $this->model->{$key} = $this->model->{$key}()
                    ->withDeferred($sessionKey)
                    ->get();
            }
            
            $this->getManager()->updateOrCreateDocument($this->model);
        } catch (Exception $e) {
            trace_log($e);
        }
    }

    protected function afterDelete(): void
    {
        try {
            $this->getManager()->deleteDocument($this->model->id);
        } catch (Exception $e) {
            trace_log($e);
        }
    }

    /**
     * getManager
     */
    protected function getManager()
    {
        return ElasticManager::make()->setParamsByModel(class_basename($this->model));
    }
}
