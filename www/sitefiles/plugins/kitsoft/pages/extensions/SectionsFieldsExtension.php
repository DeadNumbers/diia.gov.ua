<?php namespace KitSoft\Pages\Extensions;

use Event;
use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Classes\RelationField;
use KitSoft\Pages\Models\Section;

class SectionsFieldsExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
    	Event::listen('backend.form.extendFields', function ($widget) {
            if (!$widget->model instanceof Section) {
                return;
            }

            if ($widget->context !== 'update') {
                return;
            }

            // addFieldsForSection
            $widget = $this->addFieldsForSection($widget);
        });
    }

    /**
     * addFieldsForSection
     */
    protected function addFieldsForSection($widget)
    {
        if (!$fields = PagesHelper::getSectionConfig($widget->model->name)) {
            return;
        }

        $fields = RelationField::setFieldsOptions($fields);

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