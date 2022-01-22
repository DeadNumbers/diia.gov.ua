<?php

namespace KitSoft\Pages\Classes;

use Event;
use Request;

class Components
{
    protected $page;

    /**
     * init
     */
    public function __construct()
    {
        Event::listen('cms.page.initComponents', function ($page, $layout) {
            $this->page = &$page;
            if (!$pagesComponent = $page->findComponentByName('page')) {
                return;
            }

            $pagesComponent->onRun();

            if (!$pagesComponent->data) {
                return;
            }

            // set sluggable for set route params
            $sluggable = $pagesComponent->data->sluggable;

            // prepare and add components to the page
            $pagesComponent->data
                ->components()
                ->isPublished()
                ->get()
                ->filter(function ($item) {
                    return class_exists($item->class);
                })->each(function ($item) use ($layout, $sluggable) {
                    $component = $this->page->addComponent(
                        $item->class ?? $item->name,
                        $item->alias,
                        $item->properties ?? []
                    );
                    $component->setProperty('custom_fields', $item->fields ?? []);
                    $component->onRun();
                });
        });
    }
}
