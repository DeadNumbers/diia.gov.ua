<?php namespace KitSoft\Diia\Extensions;

use Event;
use KitSoft\Faq\Models\Question;
use KitSoft\Services\Controllers\Services;
use KitSoft\Services\Models\Service;

class ServicesExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
    	$this->extendModel();
    	$this->extendController();
    }

    /**
     * extendModel
     */
    protected function extendModel()
    {
    	Service::extend(function ($model) {
    		$model->belongsToMany['questions'] = [Question::class,
	            'table' => 'kitsoft_services_services_questions',
	            'key' => 'service_id',
	            'otherKey' => 'question_id'
    		];
    	});
    }

    /**
     * extendController
     */
    protected function extendController()
    {
    	Services::extend(function ($controller) {
		    $controller->relationConfig = $controller->mergeConfig(
		    	$controller->makeConfig($controller->relationConfig),
		    	$controller->makeConfig('$/kitsoft/diia/extensions/servicesextension/config_relation.yaml')
		    );
    	});

    	Event::listen('backend.form.extendFieldsBefore', function ($widget) {
            if (!$widget->model instanceof Service) {
                return;
            }

            if (request()->ajax()) {
                return;
            }

            $widget->tabs['fields']['questions'] = [
                'label' => 'Зв\'язані запитання',
                'type' => 'partial',
                'path' => '$/kitsoft/diia/extensions/servicesextension/_questions.htm',
                'tab' => 'FAQ'
            ];
        });
    }
}
