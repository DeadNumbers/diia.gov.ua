<?php namespace KitSoft\Pages\Extensions;

use Event;
use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Models\Page;

class PagesFieldsExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
        Event::listen('backend.form.extendFields', function ($widget) {
            if (!$widget->model instanceof Page) {
                return;
            }

            if ($widget->context !== 'update') {
                return;
            }

            // addFieldsForPage
            $widget = $this->addFieldsForPage($widget);
        });
    }

    /**
     * addFieldsForPage
     */
    protected function addFieldsForPage($widget)
    {
        if (!$fields = PagesHelper::getPageConfig($widget->model->layout)) {
            return;
        }

        // add fields to widget
        if (isset($fields['fields'])) {
            $widget->addFields($fields['fields']);
        }

        // add tabs fields to widget
        if (isset($fields['tabs'], $fields['tabs']['fields'])) {
            $widget->addTabFields($fields['tabs']['fields']);
        }

        // add secondary fields to widget
        if (isset($fields['secondaryTab'], $fields['secondaryTab']['fields'])) {
            $widget->addSecondaryTabFields($fields['secondaryTab']['fields']);
        }

        return $widget;
    }
}