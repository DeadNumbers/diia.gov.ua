<?php namespace KitSoft\RLBlogXT\Faker;

use KitSoft\Core\Console\Interfaces\ContentGenerationInterface;
use KitSoft\Core\Classes\AbstractContentGeneration;
use RainLab\Blog\Models\Category;

class Categories extends AbstractContentGeneration implements ContentGenerationInterface
{
    public static $sort = 2;

    /**
     * create
     */
    protected function create(): Category
    {
        $category = new Category();

        $category->name = $this->getUniqueWordForModelField(Category::make());

        $category->save();

        return $category;
    }
}