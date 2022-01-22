<?php namespace KitSoft\RLBlogXT\Faker;

use KitSoft\Core\Classes\AbstractContentGeneration;
use KitSoft\Core\Console\Interfaces\ContentGenerationInterface;
use RainLab\Blog\Models\Post;
use RainLab\Blog\Models\Category;
use KitSoft\Core\Classes\ImageFaker;
use October\Rain\Database\Model;

class Posts extends AbstractContentGeneration implements ContentGenerationInterface
{
    public static $sort = 3;

    /**
     * create
     */
    protected function create(): Post
    {
        $post = new Post();

        $post->title = $this->factory->words(4, TRUE);
        $post->slug = str_slug($post->title);
        $post->content = '<p>'.$this->factory->realText(450).'</p>';
        $post->user_id = 1;
        $post->published = true;
        $post->excerpt = $this->factory->realText(120);
        $post->is_top = $this->factory->boolean;
        $post->is_fixed = $this->factory->boolean;
        $post->published_at = $this->factory->dateTime();
        $post->categories = $this->getRandomModel(Category::make());

        $this->attachRandomTag($post);
        $this->attachImage($post);

        $post->save();

        return $post;
    }

    /**
     * attachImage
     */
    protected function attachImage(Model $model)
    {
        $image = new ImageFaker();

        for ($i = 0; $i < random_int(0, 4); $i++) {
            if (file_exists($fake_image = $image->image())) {
                $model->featured_images = $fake_image;
            }
        }
    }
}