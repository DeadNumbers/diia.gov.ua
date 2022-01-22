<?php

namespace KitSoft\TagsManager\Extensions;

use Event;
use System\Classes\PluginManager;
use KitSoft\TagsManager\Models\Tag;
use RainLab\Pages\Classes\Page as PageModel;
use RainLab\Pages\Controllers\Index as PagesController;

class RainLabPagesExtension
{
    /**
     * __construct
     */
    public function __construct() {
        if (!PluginManager::instance()->hasPlugin('RainLab.Pages')) {
            return;
        }

        Event::listen('backend.form.extendFields', function ($widget) {
            if (!$widget->getController() instanceof PagesController || !$widget->model instanceof PageModel) {
                return;
            }

            $widget->addTabFields([
                'viewBag[tags]' => [
                    'label' => 'kitsoft.tagsmanager::lang.tag.name',
                    'type' => 'taglist',
                    'customTags' => false,
                    'options' => Tag::all()->lists('name', 'id'),
                    'tab' => 'cms::lang.editor.settings',
                ]
            ]);
        });
    }
}
