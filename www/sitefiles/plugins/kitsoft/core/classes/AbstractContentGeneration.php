<?php namespace KitSoft\Core\Classes;

use Model;
use Faker\Factory;
use KitSoft\TagsManager\Models\Tag;
use System\Classes\PluginManager;
use Config;

abstract class AbstractContentGeneration
{
    protected $count = 10;
    protected $image = true;
    protected $factory;

    /**
     * __construct
     */
    public function __construct(int $count = null)
    {
        $this->count = $count ?? $this->count;
        $this->factory = Factory::create('uk_UA');
    }

    /**
     * run
     */
    public function run()
    {
        for ($i = 0; $i < $this->count; $i++) {
            $this->create();
        }
    }

    /**
     * disableImages
     */
    public function disableImages() {
        $this->image = false;
    }

    /**
     * getRandomModel
     */
    public function getRandomModel(Model $model)
    {
        if ($this->factory->boolean) {
            return;
        }

        return $model->inRandomOrder()->first();
    }

    /**
     * attachRandomTag
     */
    public function attachRandomTag(Model $model)
    {
        if (PluginManager::instance()->hasPlugin('KitSoft.TagsManager')) {
            $model->tags = $this->getRandomModel(Tag::make());
        }
    }

    /**
     * getUniqueWordForModelField
     */
    public function getUniqueWordForModelField(Model $model, string $field = 'name')
    {
        $word = $this->factory->words(2, true);

        if ($model->where($field, $word)->count()) {
            return $this->getUniqueWordForModelField($model, $field);
        }

        return $word;
    }

    /**
     * attachImage
     */
    protected function attachImage(Model $model, string $field = 'avatar', $number = false)
    {
        if (!$this->image) {
            return;
        }

        $image = new ImageFaker();

        $limit = $number ? random_int(0, 4) : 1;

        for ($i = 0; $i < $limit; $i++) {
            if (file_exists($fake_image = $image->image())) {
                $model->$field = $fake_image;
            }
        }
    }

    /**
     * getRandomYoutubeId
     */
    public function getRandomYoutubeId()
    {
        return $this->factory->randomElement(Config::get('kitsoft.core::youtubeId'));
    }
}