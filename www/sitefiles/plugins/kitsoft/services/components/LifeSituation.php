<?php namespace KitSoft\Services\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Services\Models\LifeSituation as LifeSituationModel;

class LifeSituation extends ComponentBase
{
    public $item;

    public function componentDetails()
    {
        return [
            'name'        => 'Life Situation',
            'description' => ''
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        if (!$this->item = $this->loadLifeSituation()) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        $this->item->siblings = $this->item->siblings()
            ->isPublished()
            ->get();

        $this->page->hash = $this->item->hash;

        $this->setSeoTags();
        $this->setOgTags();
    }

    /**
     * loadLifeSituation
     */
    protected function loadLifeSituation()
    {
        return LifeSituationModel::isPublished()
            ->with(['services' => function ($query) {
                return $query->isPublished();
            }])
            ->where('slug', $this->param('slug'))
            ->first();
    }

    /**
     * setSeoTags
     */
    protected function setSeoTags()
    {
        $this->page->meta_title = $this->item->meta_title
            ? $this->item->meta_title
            : $this->item->title;

        $this->page->meta_description = $this->item->meta_description
            ? $this->item->meta_description
            : ($this->item->excerpt
                ? $this->item->excerpt
                : str_before(strip_tags($this->item->html_content), '.')
            );
    }

    /**
     * setOgTags
     */
    protected function setOgTags()
    {
        if (!$this->item->og_image) {
            return;
        }

        $this->page->og_image = media_url($this->item->og_image);
    }
}
