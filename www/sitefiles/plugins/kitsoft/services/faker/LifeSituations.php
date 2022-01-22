<?php namespace KitSoft\Services\Faker;

use KitSoft\Core\Console\Interfaces\ContentGenerationInterface;
use KitSoft\Core\Classes\AbstractContentGeneration;
use KitSoft\Services\Models\SubCategory;
use KitSoft\Services\Models\LifeSituation;
use October\Rain\Database\Model;
use KitSoft\Core\Classes\ImportHelpers;

class LifeSituations extends AbstractContentGeneration implements ContentGenerationInterface
{
    public static $sort = 17;

    /**
     * create
     */
    protected function create(): LifeSituation
    {
        $lifeSituation = new LifeSituation();

        $lifeSituation->title = $this->getUniqueWordForModelField(LifeSituation::make(), 'title');
        $lifeSituation->slug = ImportHelpers::getUniqueSlug($lifeSituation, str_slug($lifeSituation->title), 'slug', '-', 191);
        $lifeSituation->published = true;
        $lifeSituation->excerpt = $this->factory->words(4, TRUE);
        $lifeSituation->subcategories = $this->getRandomModel(SubCategory::make());
        $lifeSituation->parent_id = $this->getRandomParentId(LifeSituation::make());

        $this->attachImage($lifeSituation, 'image');

        $lifeSituation->save();

        return $lifeSituation;
    }

    /**
     * getRandomParentId
     */
    public function getRandomParentId(Model $model)
    {
        if ($this->factory->boolean) {
            return;
        }

        if (!$model->first()) {
            return;
        }

        return $model->whereNull('parent_id')->inRandomOrder()->first()->id;
    }

}