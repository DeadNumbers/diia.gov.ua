<?php

namespace KitSoft\Revisions\Extensions;

use App;
use Config;

class PluginsExtension
{
    /**
     * __construct
     */
    public function __construct()
    {
        $this->extendModels();
        $this->extendControllers();
    }

    /**
     * extendModels
     */
    protected function extendModels()
    {
        $models = Config::get('kitsoft.revisions::models');

        foreach ($models as $model) {
            if (!class_exists($model)) {
                continue;
            }

            // extend models
            $model::extend(function ($model) {
                $behavior = 'KitSoft.Revisions.Behaviors.RevisionsModel';

                if ($model->implement) {
                    if (in_array($behavior, $model->implement)) {
                        return;
                    }

                    if (in_array("@{$behavior}", $model->implement)) {
                        return;
                    }
                }

                $model->implement[] = $behavior;
            }, 4);
        }
    }

    /**
     * extendControllers
     */
    protected function extendControllers() {
        $controllers = Config::get('kitsoft.revisions::controllers');

        foreach ($controllers as $controller) {
            if (!class_exists($controller)) {
                continue;
            }

            // extend controller
            $controller::extend(function ($controller) {
                $behavior = 'KitSoft.Revisions.Behaviors.RevisionsController';

                if ($controller->implement) {
                    if (in_array($behavior, $controller->implement)) {
                        return;
                    }

                    if (in_array("@{$behavior}", $controller->implement)) {
                        return;
                    }
                }

                $controller->implement[] = $behavior;
            }, 4);
        }
    }
}
