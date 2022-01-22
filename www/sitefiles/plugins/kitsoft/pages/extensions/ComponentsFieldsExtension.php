<?php namespace KitSoft\Pages\Extensions;

use Cms\Classes\Page as CmsPage;
use Cms\Classes\Theme;
use Event;
use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Classes\RelationField;
use KitSoft\Pages\Models\Component;
use KitSoft\Pages\Models\Page;

class ComponentsFieldsExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
        Event::listen('backend.form.extendFields', function ($widget) {
            if (!$widget->model instanceof Component) {
                return;
            }

            if ($widget->context !== 'update') {
                return;
            }

            // addFieldsForComponent
            $widget = $this->addFieldsForComponent($widget);
        });
    }

    /**
     * addFieldsForComponent
     */
    protected function addFieldsForComponent($widget)
    {
        $fields = PagesHelper::getComponentConfig($widget->model->class, $widget->model->name);

        $component = new $widget->model->class();
        $componentProperties = $component->defineProperties();

        foreach ($componentProperties as $key => $field) {
            if (isset($fields['tabs']['fields']['properties[' . $key . ']'])) {
                continue;
            }
            // set type
            switch ($field['type'] ?? null) {
                case 'dropdown':
                    $type = 'dropdown';
                    break;
                case 'balloon-selector':
                    $type = 'balloon-selector';
                    break;
                case 'checkbox':
                    $type = 'checkbox';
                    break;
                case 'string':
                    $type = 'text';
                    break;
                case 'text':
                    $type = 'textarea';
                    break;
                case 'repeater':
                    $type = 'repeater';
                    break;
                case 'checkboxlist':
                    $type = 'checkboxlist';
                    break;
                case 'relationfinder':
                    $type = 'relationfinder';
                    break;
                case 'datepicker':
                    $type = 'datepicker';
                    break;
                case 'switch':
                    $type = 'switch';
                    break;
                case 'section':
                    $type = 'section';
                    break;
                case 'hidden':
                    continue 2;
                default:
                    $type = 'text';
                    break;
            }

            // set options
            $options = (in_array($type, ['dropdown', 'balloon-selector']) && !isset($field['options']))
                ? $component->{"get{$key}Options"}()
                : (isset($field['options']) ? $field['options'] : null);

            $options = $this->replacePagesOptions($options);

            $fields['tabs']['fields']['properties[' . $key . ']'] = [
                'label' => $field['title'],
                'default' => $field['default'] ?? null,
                'required' => $field['required'] ?? null,
                'tab' => $field['group'] ?? 'kitsoft.pages::lang.components.tabs.properties',
                'span' => $field['span'] ?? 'auto',
                'type' => $type,
                'mode' => $field['mode'] ?? null,
                'form' => $field['form'] ?? null,
                'options' => $options,
                'emptyOption' => $field['emptyOption'] ?? null,
                'comment' => $field['description'] ?? null,
                'commentHtml' => $field['commentHtml'] ?? null,
                'trigger' => $field['trigger'] ?? null,
                'prompt' =>  $field['prompt'] ?? null,
                'style' => $field['style'] ?? null,
            ];
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

    /**
     * replacePagesOptions
     */
    protected function replacePagesOptions($options)
    {
        if (!is_array($options)) {
            return;
        }
        $cmsPages = CmsPage::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');

        if (array_keys($options) == array_keys($cmsPages)) {
            return Page::make()->getPagesOptions();
        }
        return $options;
    }
}
