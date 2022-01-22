<?php namespace KitSoft\Services\Faker;

use KitSoft\Core\Console\Interfaces\ContentGenerationInterface;
use KitSoft\Core\Classes\AbstractContentGeneration;
use KitSoft\Services\Models\SubCategory;
use KitSoft\Services\Models\Service;
use October\Rain\Database\Model;
use KitSoft\Pages\Models\Section;
use KitSoft\Core\Classes\ImportHelpers;

class Services extends AbstractContentGeneration implements ContentGenerationInterface
{
    public static $sort = 16;

    /**
     * create
     */
    protected function create(): Service
    {
        $service = new Service();

        $service->title = $this->getUniqueWordForModelField(Service::make(), 'title');
        $service->slug = ImportHelpers::getUniqueSlug($service, str_slug($service->title), 'slug', '-');
        $service->published = true;
        $service->is_top = $this->factory->boolean;
        $service->description = $this->factory->words(4, TRUE);
        $service->subcategories = $this->getRandomModel(SubCategory::make());
        $service->related_services = $this->getRandomModel(Service::make());
        $service->type = $this->factory->randomElement(['content', 'link']);

        $this->attachImage($service, 'image');
        $this->attachRandomTag($service);

        $service->forceSave();

        $this->attachContent($service, $service->type);

        return $service;
    }

    /**
     * attachContent
     */
    protected function attachContent(Model $model, $type)
    {
        switch ($type) {
            case 'content':
                $model->sections()->attach($this->addSection());
                break;
            case 'link':
                $model->fields = [
                    'link' => $this->factory->url,
                    'link_label' => $this->factory->words(4, TRUE),
                    'target' => $this->factory->boolean
                    ];

                $model->forceSave();
        }
    }

    /**
     * addSection
     */
    protected function addSection()
    {
        $section = Section::make();

        $section->name = 'serviceContent';
        $section->title = 'Сервіс - Контент';
        $section->published = true;
        $section->fields = [
            'content' => '<p>'.$this->factory->realText(450).'</p>'
        ];

        $section->save();

        return $section;
    }
}