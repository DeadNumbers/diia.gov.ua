<?php namespace KitSoft\Services\Faker;

use KitSoft\Core\Console\Interfaces\ContentGenerationInterface;
use KitSoft\Core\Classes\AbstractContentGeneration;
use KitSoft\Services\Models\SubCategory;
use KitSoft\Services\Models\Category;
use KitSoft\Core\Classes\ImportHelpers;

class SubCategories extends AbstractContentGeneration implements ContentGenerationInterface
{
    public static $sort = 15;

    /**
     * create
     */
    protected function create(): SubCategory
    {
        $subCategory = new SubCategory();

        $subCategory->name = $this->getUniqueWordForModelField(SubCategory::make());
        $subCategory->slug = ImportHelpers::getUniqueSlug($subCategory, str_slug($subCategory->name));
        $subCategory->description = $this->factory->words(4, TRUE);
        $subCategory->categories = $this->getRandomModel(Category::make());

        $subCategory->save();

        return $subCategory;
    }
}