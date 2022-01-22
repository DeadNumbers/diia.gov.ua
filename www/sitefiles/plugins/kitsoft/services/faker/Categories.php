<?php namespace KitSoft\Services\Faker;

use KitSoft\Core\Console\Interfaces\ContentGenerationInterface;
use KitSoft\Core\Classes\AbstractContentGeneration;
use KitSoft\Services\Models\Category;
use KitSoft\Core\Classes\ImportHelpers;

class Categories extends AbstractContentGeneration implements ContentGenerationInterface
{
    public static $sort = 14;

    /**
     * create
     */
    protected function create(): Category
    {
        $category = new Category();

        $category->name = $this->getUniqueWordForModelField(Category::make());
        $category->slug = ImportHelpers::getUniqueSlug($category, str_slug($category->name), 'slug', '-');
        $category->description = $this->factory->words(4, TRUE);
        $category->is_top = $this->factory->boolean;

        $category->save();

        return $category;
    }
}