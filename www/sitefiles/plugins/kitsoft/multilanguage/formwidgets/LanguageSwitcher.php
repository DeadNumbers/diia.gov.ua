<?php namespace KitSoft\MultiLanguage\FormWidgets;

use Request;
use Backend\Classes\FormWidgetBase;
use KitSoft\MultiLanguage\Models\Locale;
use KitSoft\MultiLanguage\Classes\MultiLanguage;

class LanguageSwitcher extends FormWidgetBase
{
    protected $ml;
    public $context;
    public $relationId;
    public $languages;
    public $activeLang;
    public $langEntities;

    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->setRelationId();
        $this->setContext();

        $this->ml = MultiLanguage::instance();
        $this->languages = Locale::listEnabled();
        $this->activeLang = $this->model->lang
            ? $this->model->lang->locale
            : $this->ml->getActiveLocale();
    }

    /**
     * setRelationId
     */
    protected function setRelationId()
    {
        $this->relationId = Request::has('relation_id')
            ? Request::get('relation_id')
            : null;
    }

    /**
     * setContext
     */
    protected function setContext()
    {
        if (!$this->model->id && $this->relationId) {
            $this->context = 'createEntity';
            return;
        }
        
        $this->context = $this->model->id ?
            'update' :
            'create';
    }

    /**
     * render
     */
    public function render()
    {
        return $this->makePartial('languageswitcher');
    }

    /**
     * getCreateEntitySwitcher
     */
    public function getCreateEntitySwitcher()
    {
        $langEntities = Locale::getLangEntities($this->relationId, get_class($this->model));

        // Generate links for create/update entities models
        foreach ($this->languages as $lang => $langName) {
            if ($this->activeLang == $lang) {
                continue;
            }
            if ($entity_id = array_search($lang, $langEntities)) {
                $switcher[$lang] = [
                    'name'   => $langName,
                    'action' => 'edit',
                    'url'    => str_replace('/create', "/update/$entity_id", request()->url())
                ];
            } else {
                $switcher[$lang] = [
                    'name'   => $langName,
                    'action' => 'create',
                    'url'    => request()->url() . "?relation_id=$this->relationId"
                ];
            }
        }

        return $switcher;
    }

    /**
     * getUpdateSwitcher
     */
    public function getUpdateSwitcher()
    {
        $langEntities = $this->model->lang
            ? Locale::getLangEntities($this->model->lang->relation_id, get_class($this->model))
            : [];

        $switcher = [];
        foreach ($this->languages as $lang => $langName) {
            if ($this->activeLang == $lang) {
                continue;
            }
            if ($entity_id = array_search($lang, $langEntities)) {
                $switcher[$lang] = [
                    'name'   => $langName,
                    'action' => 'edit',
                    'url'    => str_replace(
                        'update/' . $this->model->id,
                        'update/' . $entity_id,
                        request()->url()
                    )
                ];
            } else {
                $switcher[$lang] = [
                    'name'   => $langName,
                    'action' => 'create',
                    'url'    => str_replace(
                        'update/' . $this->model->id,
                        'create?relation_id=' . ($this->model->lang ? $this->model->lang->relation_id : $this->model->id),
                        request()->url()
                    )
                ];
            }
        }

        return $switcher;
    }
}
