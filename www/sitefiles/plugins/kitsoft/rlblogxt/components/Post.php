<?php namespace KitSoft\RLBlogXT\Components;

use Event;
use KitSoft\Core\Classes\ImportHelpers;
use KitSoft\MultiLanguage\Classes\LocaleSwitcher;
use RainLab\Blog\Models\Post as PostModel;

class Post extends \RainLab\Blog\Components\Post
{
    public $relatedPosts;

    /**
     * componentDetails
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'kitsoft.rlblogxt::lang.components.post.name',
            'description' => 'kitsoft.rlblogxt::lang.components.post.description'
        ];
    }

    /**
     * defineProperties
     * @return array
     */
    public function defineProperties() {
        return array_merge(parent::defineProperties(), [
            'loadRelated' => [
                'title' => 'kitsoft.rlblogxt::lang.components.post.fields.load_related',
                'type'  => 'checkbox',
                'group' => 'kitsoft.rlblogxt::lang.components.post.tabs.related_news',
                'span'  => false
            ],
            'relatedType' => [
                'title' => 'kitsoft.rlblogxt::lang.components.post.fields.related_type',
                'type'  => 'dropdown',
                'options' => [
                    'tags'       => 'kitsoft.rlblogxt::lang.components.post.fields.related_type_options.tags',
                    'categories' => 'kitsoft.rlblogxt::lang.components.post.fields.related_type_options.categories',
                    'tag'        => 'kitsoft.rlblogxt::lang.components.post.fields.related_type_options.tag',
                    'category'   => 'kitsoft.rlblogxt::lang.components.post.fields.related_type_options.category'
                ],
                'default' => 'category',
                'group'   => 'kitsoft.rlblogxt::lang.components.post.tabs.related_news'
            ],
            'relatedCount' => [
                'title'   => 'kitsoft.rlblogxt::lang.components.post.fields.related_count',
                'type'    => 'dropdown',
                'options' => array_combine($range = range(1, 20), $range),
                'default' => 3,
                'group'   => 'kitsoft.rlblogxt::lang.components.post.tabs.related_news'
            ]
        ]);
    }

    /**
     * onRun
     */
    public function onRun()
    {
        if (!$this->post = $this->loadPost()) {
            $this->setStatusCode(404);
            
            return $this->controller->run('404');
        } 

        $this->relatedPosts = $this->loadRelatedPosts();

        $this->setMultilanguageLinks();

        $this->controller->addJs('/plugins/kitsoft/rlblogxt/assets/js/hit.js', ['data-slug' => $this->post->slug, 'id' => 'data-slug']);

        $this->setMetaTags();
        $this->setOgTags();

        $this->page->hash = $this->post->hash;
    }

    /**
     * loadPost
     */
    protected function loadPost()
    {
        return PostModel::isPublishedOrPreview()
            ->where('slug', $this->property('slug'))
            ->first();
    }

    /**
     * loadRelatedPosts
     */
    protected function loadRelatedPosts()
    {
        if (!$this->property('loadRelated')) {
            return;
        }

        $query = PostModel::isPublished()
            ->where('id', '<>', $this->post->id);

        switch ($this->property('relatedType')) {
            case 'tag':
                if (!$tag = $this->post->tags->first()) {
                    return;
                }
                $query = $query->filterTags([$tag->id]);
                break;
            case 'tags':
                if (!$tags = $this->post->tags) {
                    return;
                }
                $query = $query->filterTags($tags->lists('id'));
                break;
            case 'category':
                if (!$category = $this->post->categories->first()) {
                    return;
                }
                $query = $query->filterCategories([$category->id]);
                break;
            case 'categories':
                if (!$categories = $this->post->categories) {
                    return;
                }
                $query = $query->filterCategories($categories->lists('id'));
                break;
        }

        return $query->limit($this->property('relatedCount'))
            ->orderBy('published_at', 'desc')
            ->get();
    }

    /**
     * setMetaTags
     */
    protected function setMetaTags() {
        $this->page->meta_title = $this->post->meta_title
            ? $this->post->meta_title
            : $this->post->title;

        $this->page->meta_description = $this->post->meta_description
            ? $this->post->meta_description
            : ($this->post->excerpt
                ? $this->post->excerpt
                : str_before(strip_tags($this->post->content), '.')
            );

        $this->page->meta_keywords = $this->post->meta_keywords ?? null;
    }

    /**
     * setOgTags
     */
    protected function setOgTags() {
        if ($this->post->og_image) {
            $this->page->og_image = $this->post->og_image->getPath();
        } elseif (count($this->post->featured_images)) {
            $this->page->og_image = $this->post->featured_images->first()->getPath();
        } else {
            $contentImages = ImportHelpers::getContentImages($this->post->content);

            if (count($contentImages)) {
                $image = array_first($contentImages);
                $this->page->og_image = (substr($image, 0, 1) == '/') ? url($image) : $image;
            }
        }        
    }

    /**
     * setMultilanguageLinks
     */
    protected function setMultilanguageLinks()
    {
        Event::listen('kitsoft.multilanguage::component.ml.links', function (&$links) {
            $localeSwitcher = new LocaleSwitcher($this->post);
            $links = $localeSwitcher->getLinks();
        });
    }
}
