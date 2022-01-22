<?php namespace KitSoft\Revisions\Behaviors;

use ApplicationException;
use Backend\Facades\BackendAuth;
use Event;
use Exception;
use KitSoft\Revisions\Classes\Helpers;
use KitSoft\Revisions\Models\Revision;
use October\Rain\Extension\ExtensionBase;
use Request;
use ValidationException;
use Validator;

/**
 * RevisionsController
 */
class RevisionsController extends ExtensionBase
{
    use \System\Traits\ViewMaker;

    protected $controller;
    protected $listWidget;

    /**
     * Constructor
     */
    public function __construct($controller)
    {
        if (!BackendAuth::check()) {
            return;
        }

        $this->controller = $controller;

        $this->controller->addCss('/plugins/kitsoft/revisions/assets/css/revisions.css');
        $this->controller->addJs('/plugins/kitsoft/revisions/assets/js/revisions.js');

        // add logs button to secondary tab
        Event::listen('backend.form.extendFields', function ($form) {
            if (Request::ajax() || $form->alias !== 'form' || $form->context == 'create') {
                return;
            }
            $this->formExtendFields($form);
        });

        // bind widget for use popup and paginate
        $this->bindListWidgetToContoller();
    }

    /**
     * extendFieldsBefore
     */
    protected function formExtendFields($form)
    {
        $form->addSecondaryTabFields([
            'logs' => [
                'type' => 'partial',
                'path' => '$/kitsoft/revisions/behaviors/revisionscontroller/_logs.htm'
            ]
        ]);
    }

    /**
     * bindListWidgetToContoller
     */
    protected function bindListWidgetToContoller()
    {
        // create config
        $config = $this->controller->makeConfig('$/kitsoft/revisions/models/revision/columns.yaml');
        $config->model = new Revision();
        $config->recordsPerPage = 10;
        $config->showSorting = false;
        $config->defaultSort = [
            'column' => 'created_at',
            'direction' => 'desc'
        ];

        // create widget
        $widget = $this->controller->makeWidget('Backend\Widgets\Lists', $config);
        $widget->alias = 'formRevisionsList';
        $widget->recordOnClick = "$.revisions.clickRevision(:id)";

        // filter revisions for current object
        $widget->model::addGlobalScope('filter', function ($query) {
            $revisionable_id = last(request()->segments());
            $revisionable_type = $this->getModelClass();
            $group = Helpers::generateGroupName($revisionable_type, $revisionable_id);

            $query->where('group', $group);
        });

        $widget->bindToController();

        $this->listWidget = $widget;
    }

    /**
     * onRevisionsList
     */
    public function onRevisionsList()
    {
        return $this->listWidget
            ->makePartial('$/kitsoft/revisions/behaviors/revisionscontroller/index.htm');
    }

    /**
     * onRevisionForm
     */
    public function onRevisionForm()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'revision_id' => 'required'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $config = $this->controller->makeConfig('$/kitsoft/revisions/models/revision/fields.yaml');
        $config->model = Revision::find($data['revision_id']);

        return $this->controller
            ->makeWidget('Backend\Widgets\Form', $config)
            ->makePartial('$/kitsoft/revisions/behaviors/revisionscontroller/preview.htm');
    }

    /**
     * onRevisionRollback
     */
    public function onRevisionRollback() {
        $data = request()->all();
        $validator = Validator::make($data, [
            'revision_id' => 'required'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $revision = Revision::findOrFail($data['revision_id']);

        if (!$revision->object) {
            throw new ApplicationException("Неможливо відновити, об'єкт \"{$revision->type}\" був видалений.");
        }

        try {
            switch ($revision->action) {
                case 'update':
                    $object = $revision->object;
                    $object->{$revision->field} = $revision->old_value;
                    $object->setContext('rollback');
                    $object->save();
                    break;
                default:
                    throw Exception("Неможливо відновити дію [{$revision->action}]");
            }
        } catch (Exception $e) {
            throw new ApplicationException("Error: {$e->getMessage()}");
        }
    }

    /**
     * getModelClass
     */
    protected function getModelClass()
    {
        return $this->controller->asExtension('Backend.Behaviors.ListController')
            ->getConfig()
            ->modelClass;
    }
}
