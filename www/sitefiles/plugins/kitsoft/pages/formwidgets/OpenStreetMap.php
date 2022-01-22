<?php namespace KitSoft\Pages\FormWidgets;

use Backend\Classes\FormWidgetBase;

class OpenStreetMap extends FormWidgetBase
{
    const LATITUDE = 50.45;
    const LONGITUDE = 30.55;
    const ZOOM = 9;

    public $defaultAlias = 'openstreetmap';

    /**
     * loadAssets
     */
    public function loadAssets()
    {
        $this->addCss('https://unpkg.com/leaflet@1.5.1/dist/leaflet.css');
        $this->addJs('https://unpkg.com/leaflet@1.5.1/dist/leaflet.js');
    }

    /**
     * prepareVars
     */
    public function prepareVars()
    {
        $this->vars['value'] = $this->getLoadValue() ?? [];
        $this->vars['field'] = $this->formField;

        $this->vars['latitude'] = array_get($this->vars['value'], 'latitude', self::LATITUDE);
        $this->vars['longitude'] = array_get($this->vars['value'], 'longitude', self::LONGITUDE);
        $this->vars['zoom'] = array_get($this->vars['value'], 'zoom', self::ZOOM);
    }

    /**
     * getName
     */
    public function getName($name = null)
    {
        $fieldName = $this->formField->getName();

        if ($name) {
            $fieldName .= "[{$name}]";
        }

        return $fieldName;
    }

    /**
     * render
     */
    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('openstreetmap');
    }
}
