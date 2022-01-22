<?php namespace KitSoft\TagsManager\Behaviors;

use Db;
use Flash;
use Event;
use Exception;
use October\Rain\Extension\ExtensionBase;
use Validator;
use ValidationException;

class ControllerBehavior extends ExtensionBase
{
    use \Backend\Traits\WidgetMaker;
    use \System\Traits\ConfigMaker;
    use \System\Traits\ViewMaker;

    protected $controller;
    protected $attachTagsFields = '$/kitsoft/tagsmanager/behaviors/controllerbehavior/attach_tags.yaml';
    protected $attachTagsJs = '/plugins/kitsoft/tagsmanager/behaviors/controllerbehavior/attachtags.js';

    /**
     * __construct
     */
    public function __construct($controller)
    {
        $this->controller = $controller;

        // add tags field to form
        Event::listen('backend.form.extendFields', function ($controller, $query) {
            if (!$controller->model->tags || $controller->alias !== 'form') {
                return;
            }

            $tabFn = (count($controller->tabs['fields']))
                ? 'addTabFields'
                : 'addSecondaryTabFields';

            $controller->$tabFn([
                'tags' => [
                    'label' => 'kitsoft.tagsmanager::lang.tag.name',
                    'type' => 'taglist',
                    'mode' => 'relation',
                    'customTags' => false,
                    'tab' => 'rainlab.blog::lang.post.tab_manage'
                ]
            ]);
        });

        // add column to list
        Event::listen('backend.list.extendColumns', function ($list) {
            if (!$list->model->tags) {
                return;
            }

            $list->addColumns([
                'tags' => [
                    'label' => 'kitsoft.tagsmanager::lang.tag.name',
                    'type' => 'partial',
                    'path' => '$/kitsoft/tagsmanager/partials/_tags_column.php',
                    'searchable' => false,
                    'sortable' => false
                ]
            ]);
        });

        // load with tags
        Event::listen('backend.list.extendQuery', function ($widget, $query) {
            if ($widget->model->hasRelation('tags')) {
                $query->with('tags');
            }
            if (!$this->controller->disableAttachTagsList) {
                $this->controller->addJs($this->attachTagsJs);
            }
        });
    }

    /**
     * getModel
     */
    protected function getModel()
    {
        return $this->controller
            ->asExtension('Backend.Behaviors.FormController')
            ->getConfig('modelClass')::make();
    }

    /**
     * onAttachTags
     */
    public function onAttachTags()
    {
        $data = request()->all();

        $validator = Validator::make($data, [
            'checked' => 'required|array',
            'tags' => 'required|array',
            'action' => 'required|in:attach,detach'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        Db::beginTransaction();

        try {
            $count = count($data['checked']);

            $this->getModel()
                ->whereIn('id', $data['checked'])
                ->get()
                ->each(function ($item) use ($data) {
                    switch ($data['action']) {
                        case 'attach':
                            $item->tags()->syncWithoutDetaching($data['tags']);
                            break;
                        case 'detach':
                            $item->tags()->detach($data['tags']);
                            break;
                    }
                });
        } catch (Exception $e) {
            Db::rollback();
            trace_log($e);
            Flash::error('Виникла помилка. ' . $e->getMessage());
            return;
        }

        Db::commit();

        switch ($data['action']) {
            case 'attach':
                Flash::success("Успішно протеговано рядків: {$count}.");
                break;
            case 'detach':
                Flash::success("Успішно тегів видалено для рядків: {$count}.");
                break;
        }
    }

    /**
     * onAttachTagsButton
     */
    public function onAttachTagsButton()
    {
        return $this->makePartial('toolbar');
    }

    /**
     * onAttachTagsForm
     */
    public function onAttachTagsForm()
    {
        $this->vars['checked'] = post('checked') ?? [];
        $this->vars['widget'] = $this->getAttachTagsFormWidget();

        return $this->makePartial('popup');
    }

    /**
     * getAttachTagsFormWidget
     */
    protected function getAttachTagsFormWidget()
    {
        $config = $this->makeConfig($this->attachTagsFields);
        $config->model = $this->getModel();
        $config->alias = 'attachTagsForm';

        return $this->makeFormWidget('Backend\Widgets\Form', $config);
    }
}
