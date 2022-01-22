<?php namespace KitSoft\MultiLanguage\Extensions;

use Model;
use Event;
use Backend\Widgets\Form;

class TranslateFieldsExtension
{
	/**
	 * __construct
	 */
	public function __construct() {
        Event::listen('backend.form.extendFieldsBefore', function($widget) {
        	if (!$model = $widget->model) {
	            return;
	        }

	        if (!$model->exists) {
	        	return;
	        }

	        if (!$this->isExtendedWithTranslatableFields($model)) {
	            return;
	        }

	        if (!$model->translatable) {
	        	return;
	        }

	        $this->extendFields($widget, $model->translatable);
        });
	}

	/**
	 * isExtendedWithTranslatableFields
	 */
	protected function isExtendedWithTranslatableFields(Model $model)
	{
		$behavior = 'KitSoft.MultiLanguage.Behaviors.MultiLanguageFieldsModel';

		return ($model->isClassExtendedWith($behavior) || $model->isClassExtendedWith("@{$behavior}"));
	}

	/**
	 * extendFields
	 */
	protected function extendFields(Form $widget, array $translatable)
	{
		if (isset($widget->config->fields)) {
            $widget->fields = $this->replaceFieldsType($widget->fields, $translatable);
        }

        if (isset($widget->config->tabs['fields'])) {
            $widget->tabs['fields'] = $this->replaceFieldsType($widget->tabs['fields'], $translatable);
        }

        if (isset($widget->config->secondaryTabs['fields'])) {
            $widget->secondaryTabs['fields'] = $this->replaceFieldsType($widget->secondaryTabs['fields'], $translatable);
        }
	}

	/**
     * replaceFieldsType
     */
    protected function replaceFieldsType(array $fields, array $translatable)
    {
        foreach ($translatable as $field) {
        	if (!array_has($fields, $field)) {
            	continue;
            }

            if (!$type = array_get($fields, "{$field}.type", 'text')) {
            	continue;
            }

            switch ($type) {
            	case 'text':
            		$fields[$field]['type'] = 'mltext';
            		break;
            }
        }

        return $fields;
    }
}
