<?php namespace KitSoft\TagsManager\Faker;

use KitSoft\Core\Classes\AbstractContentGeneration;
use KitSoft\Core\Console\Interfaces\ContentGenerationInterface;
use KitSoft\TagsManager\Models\Tag;

class Tags extends AbstractContentGeneration implements ContentGenerationInterface
{
    public static $sort = 1;

    /**
     * create
     */
    protected function create(): Tag
    {
        $tag = new Tag();

        $tag->name = $this->getUniqueWordForModelField(Tag::make());
        $tag->save();

        return $tag;
    }
}