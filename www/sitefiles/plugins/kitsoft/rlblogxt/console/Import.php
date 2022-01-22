<?php namespace KitSoft\RLBlogXT\Console;

use Db;
use Event;
use KitSoft\Core\Classes\ImportHelpers;
use KitSoft\RLBlogXT\Classes\ImportHelpers as BlogImportHelpers;
use KitSoft\RLBlogXT\Console\AbstractImport;
use October\Rain\Argon\Argon;
use RainLab\Blog\Models\Post;

/**
 * Readme path - /plugins/kitsoft/rlblogxt/console/ImportReadme.md
 * Console example:
 *
 * php artisan rlblogxt:import --filepath=storage/app/ucrf_main_export.csv --site_id=1 --old_host=example.com
 *
 * csv columns: source_id,title,excerpt,slug,created_at,published_at,published,categories,updated_at,content,image,image_filename,tags,url
 *
 */
class Import extends AbstractImport
{
    protected $name = 'rlblogxt:import';
    protected $description = '';

    /**
     * createItem
     */
    protected function createItem($item)
    {
        if (!empty($item['source_id']) && Post::whereRaw("fields::jsonb ->> 'source_id' = '{$item['source_id']}'")->first()) {
            $this->output->writeln("    POST EXIST, source_id: {$item['source_id']}");
            return;
        }

        Event::fire('kitsoft.rlblogxt::console.import.beforeCreateItem', [$item]);

        $post = Post::make();

        $post->title = $item['title'] ? ImportHelpers::strLimit($item['title'], 500) : null;
        $post->excerpt = $item['excerpt'] ?? null;

        $post->content = isset($item['content'])
            ? BlogImportHelpers::prepareContent($item['content'], $this->option('old_host'))
            : null;
        
        $post->slug = ImportHelpers::getUniqueSlug($post, $item['slug'] ?? str_slug($post->title));

        $post->categories = $this->getOrCreateCategories($item['categories']);
        $post->tags = $this->getTags($item);
        
        $post->published = $item['published'] ?? true;

        $post->created_at = isset($item['created_at'])
            ? Argon::parse($item['created_at'])
            : Argon::now();

        $post->published_at = isset($item['published_at'])
            ? Argon::parse($item['published_at'])
            : null;

        $post->updated_at = isset($item['updated_at'])
            ? Argon::parse($item['updated_at'])
            : Argon::now();

        $fields = [];
        if (isset($item['source_id'])) {
            $fields['source_id'] = $item['source_id'];
        }
        if (isset($item['url'])) {
            $fields['source_uri'] = $item['url'];
        }
        $post->fields = $fields;
        
        $post->save();

        if (isset($item['image'])) {
            BlogImportHelpers::attachPostImage($item['image'], $item['image_filename'] ?? null, $post);
        }

        BlogImportHelpers::createRedirect($post);

        $this->output->writeln("    ID: {$post->id}");
        $this->output->writeln("    TITLE: {$post->title}");
        $this->info("    Post created");
    }

    /**
     * getOrCreateCategories
     */
    protected function getOrCreateCategories($categories)
    {
        $categories = explode(',', $categories);

        foreach ($categories as $row) {
            $categoriesIds[] = BlogImportHelpers::getOrCreateCategory($row)->id;
        }

        return $categoriesIds;
    }
}
