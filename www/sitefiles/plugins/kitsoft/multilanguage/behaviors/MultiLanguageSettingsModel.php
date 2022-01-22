<?php namespace KitSoft\MultiLanguage\Behaviors;

use App;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use Model;
use October\Rain\Extension\ExtensionBase;

/**
 * Base class for model behaviors.
 */
class MultiLanguageSettingsModel extends ExtensionBase
{
    protected $model;

    /**
     * Constructor
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->setSettingsCode();

        $this->model->addHidden([
            'locale',
            'entity_id',
            'relation_id',
            'entity_type'
        ]);
    }

    /**
     * setSettingsCode
     */
    protected function setSettingsCode()
    {
        $locale = MultiLanguage::instance()->getActiveLocale();
        $this->model->settingsCode .= "[{$locale}]";
    }
}
