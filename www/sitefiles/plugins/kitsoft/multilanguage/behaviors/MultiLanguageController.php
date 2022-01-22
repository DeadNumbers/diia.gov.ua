<?php namespace KitSoft\MultiLanguage\Behaviors;

use Backend;
use Db;
use Event;
use Exception;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\Pages\Models\SystemFile;
use October\Rain\Extension\ExtensionBase;
use RainLab\Blog\Models\Post;
use Redirect;
use Request;
use URL;

/**
 * Base class for model behaviors.
 */
class MultiLanguageController extends ExtensionBase
{
    protected $controller;

    /**
     * Constructor
     */
    public function __construct($controller)
    {
        $this->controller = $controller;

        Event::listen('backend.form.extendFields', function ($controller, $query) {
            if (Request::ajax() || !$controller->model->translatable || $controller->alias != 'form') {
                return;
            }

            if ($controller->context == 'preview') {
                return;
            }

            if ($this->controller->disableMultiLanguageField) {
                return;
            }

            $controller->addSecondaryTabFields([
                'language-switcher' => [
                    'label' => 'kitsoft.multilanguage::lang.switcher.label',
                    'type' => 'languageswitcher'
                ]
            ]);

            // Copy
            if (!$parentId = Request::get('copy')) {
                return;
            }
            $newId = $this->copy($parentId, $controller->model);
            $this->redirectNewModel($newId);
        });

        Event::listen('backend.list.extendColumns', function($lists) {
            if (!$lists->model->translatable) {
                return;
            }

            $lists->addColumns([
                'langs' => [
                    'label' => 'kitsoft.multilanguage::lang.switcher.label',
                    'type' => 'partial',
                    'path' => '$/kitsoft/multilanguage/behaviors/multilanguagecontroller/_langs.htm',
                    'sortable' => false,
                    'searchable' => false,
                    'clickable' => false,
                    'recordUrl' => Backend::url($lists->recordUrl)
                ]
            ]);
        });
    }

    /**
     * copy
     */
    protected function copy($id, $model)
    {
        DB::beginTransaction();
        try {
            $modelName = get_class($model);

            if (!$data = $modelName::withoutGlobalScopes()->find($id)) {
                return false;
            }

            $data = $this->clearNestedTree($data);

            Event::fire('kitsoft.multilanguage.copyBefore', [&$data, $model]);

            $clone = $data->replicate();
            $clone->push();

            // copy single images
            foreach ($data->attachOne as $key => $row) {
                if (!$data->{$key}) {
                    continue;
                }
                $clone->{$key}()->add(
                    (new SystemFile())->fromFile($data->{$key}->getLocalPath())
                );
            }

            // copy multi images
            foreach ($data->attachMany as $key => $row) {
                foreach ($data->{$key} as $row) {
                    if ($row->field_type == 'mediafinder') {
                        continue;
                    }
                    $clone->{$key}()->add(
                        (new SystemFile())->fromFile($row->getLocalPath())
                    );
                }
            }            

            Event::fire('kitsoft.multilanguage.copyAfter', [$data, $clone->id]);
        } catch (Exception $e) {
            Db::rollback();
            throw new Exception('Error copy model, ID: ' . $id . '. ' . $e->getMessage());
        }
        Db::commit();

        return $clone->id;
    }

    /**
     * copy
     */
    protected function redirectNewModel($id)
    {
        $segments = Request::segments();
        end($segments);
        $segments[key($segments)] = 'update';
        $segments[] = $id;

        header("Location: /" . implode('/', $segments));
        die();
    }

    /**
     * clearNestedTree
     */
    protected function clearNestedTree($data)
    {
        if ($data->parent_id && $data->nest_left) {
            unset($data->parent_id);
        }
        if ($data->nest_left) {
            unset($data->nest_left);
        }
        if ($data->nest_right) {
            unset($data->nest_right);
        }
        if ($data->nest_depth) {
            unset($data->nest_depth);
        }

        return $data;
    }
}
