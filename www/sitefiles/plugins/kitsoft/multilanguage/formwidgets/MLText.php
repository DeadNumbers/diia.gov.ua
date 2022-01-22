<?php namespace KitSoft\MultiLanguage\FormWidgets;

use Backend\Classes\FormWidgetBase;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\MultiLanguage\Models\Field;
use KitSoft\MultiLanguage\Models\Locale;

/**
 * MLText
 */
class MLText extends FormWidgetBase
{
    public $defaultLocale;

    protected $defaultAlias = 'mltext';

    /**
     * init
     */
    public function init()
    {
        $this->defaultLocale = MultiLanguage::instance()->getDefaultLocale();
    }

    /**
     * render
     */
    public function render()
    {
        $this->prepareLocaleVars();

        $this->addJs('/plugins/kitsoft/multilanguage/formwidgets/mltext/assets/js/mltext.js');
        $this->addCss('/plugins/kitsoft/multilanguage/formwidgets/mltext/assets/css/mltext.css');

        return $this->makePartial('mltext');
    }

    /**
     * prepareLocaleVars
     */
    public function prepareLocaleVars()
    {
        $this->vars['locales'] = Locale::all();
        $this->vars['field'] = $this->formField;
    }

    /**
     * getLocaleValue
     */
    public function getLocaleValue(string $locale)
    {
        if ($this->defaultLocale == $locale) {
            return $this->formField->value;
        }

        return Field::get($this->model, $locale);
    }

    /**
     * getSaveValue
     */
    public function getSaveValue($value)
    {
        if (!$this->model->exists) {
            return $value;
        }
        
        Locale::all()->each(function ($item) {
            if (!$value = request()->input("ML.{$item->code}.{$this->fieldName}")) {
                Field::remove($this->model, $item->code);
                return;
            }
            
            Field::createOrUpdate($this->model, $item->code, $value);
        });

        return request()->input("ML.{$this->defaultLocale}.{$this->fieldName}");
    }
}