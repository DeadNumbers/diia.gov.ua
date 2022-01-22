<?php namespace KitSoft\Pages\Extensions;

use Event;
use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Models\Partial;

class PartialsFieldsExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
        Event::listen('backend.form.extendFields', function ($widget) {
            if (!$widget->model instanceof Partial) {
                return;
            }

            if ($widget->context !== 'update') {
                return;
            }

            // addFieldsForPartial
            $widget = $this->addFieldsForPartial($widget);
        });
    }

    /**
     * addFieldsForComponent
     */
    protected function addFieldsForPartial($widget)
    {
        if (!$fields = PagesHelper::getPartialConfig($widget->model->code)) {
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
        if (isset($fields['secondaryTabs'], $fields['secondaryTabs']['fields'])) {
            $widget->addSecondaryTabFields($fields['secondaryTabs']['fields']);
        }

        return $widget;
    }
}