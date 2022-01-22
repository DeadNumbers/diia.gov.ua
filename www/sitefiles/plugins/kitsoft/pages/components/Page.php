<?php namespace KitSoft\Pages\Components;

use App;
use Config;
use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use Event;
use KitSoft\MultiLanguage\Classes\LocaleSwitcher;

class Page extends ComponentBase
{
    public $data;
    public $breadcrumbs;

    protected $segments;
    protected $cmsObject;

    /**
     * __construct
     */
    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);

        $this->cmsObject = $cmsObject;

        App::make('KitSoft\Pages\Classes\Components');
    }

    /**
     * componentDetails
     */
    public function componentDetails()
    {
        return [
            'name'        => 'kitsoft.pages::lang.components.page.name',
            'description' => 'kitsoft.pages::lang.components.page.description'
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        if (!$this->data = $this->cmsObject->pagesModel) {
            return $this->controller->run('404');
        }

        // redirect if set
        if (!empty($this->data->fields['link']['url'])) {
            return redirect($this->data->fields['link']['url']);
        }

        $this->breadcrumbs = $this->loadBreadcrumbs($this->data);
        $this->setMultilanguageLinks();

        $this->addJs('assets/js/ajax.js');

        // backend toolbar
        if (Config::get('kitsoft.pages::config.enableBackendToolbar')) {
            $this->addJs('assets/js/backend_toolbar.js');
            $this->page->hash = $this->data->hash;
        }
    }

    /**
     * loadBreadcrumbs
     */
    protected static function loadBreadcrumbs($page)
    {
        $parents = $page->getParentsCollection();
        $parents->push($page);
        
        $result = [];

        foreach ($parents as $row) {
            $result[] = [
                'title' => $row->title,
                'url' => $row->url,
                'target' => $row->target,
                'sluggable' => $row->sluggable
            ];
        }

        return $result;
    }

    /**
     * setMultilanguageLinks
     */
    protected function setMultilanguageLinks()
    {
        Event::listen('kitsoft.multilanguage::component.ml.links', function (&$links) {
            $localeSwitcher = new LocaleSwitcher($this->data);
            $links = $localeSwitcher->getLinks();
        });
    }
}
