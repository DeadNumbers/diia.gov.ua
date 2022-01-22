<?php namespace KitSoft\RLBlogXT\Extensions;

use Event;
use KitSoft\Core\Classes\BackendPreview;
use KitSoft\RLBlogXT\Classes\Helpers;
use RainLab\Blog\Models\Settings;
use Rainlab\Blog\Controllers\Posts;
use Rainlab\Blog\Models\Post;

class BlogPostExtension
{
    protected $hiddenFields = [
        'metadata',
        'content_html',
        'user_id',
        'meta_h1',
        'fields',
        'locale',
        'entity_id',
        'relation_id',
        'entity_type',
        'site_id',
        'summary',
        'has_summary'
    ];

    /*
     * Construct
     */
    public function __construct()
    {
        $this->extendPostFields();
        $this->extendPostsModel();
        $this->extendPostsController();
    }

    /**
     * extendPostFields
     */
    protected function extendPostFields()
    {
        Event::listen('backend.form.extendFieldsBefore', function ($widget) {
            if (!$widget->model instanceof Post) {
                return;
            }

            unset($widget->fields['title']['span'], $widget->fields['slug']['span']);

            $widget->fields['toolbar']['span'] = 'auto';

            $widget->secondaryTabs['fields']['content'] = [
                'tab' => 'rainlab.blog::lang.post.tab_edit',
                'type' => 'richeditor',
                'cssClass' => 'field-slim blog-post-preview',
                'stretch' => true
            ];

            $this->configurateMultimediaFinder($widget);
        });
    }

    /**
     * extendPosts
     */
    protected function extendPostsModel()
    {
        Post::extend(function ($model) {
            $model->addJsonable('fields');

            $model->rules['title'] = 'required|max:500';
            $model->rules['slug'][] = 'max:191';

            $model->implement[] = '@KitSoft.Pages.Behaviors.RelationFinderModel';
            $model->implement[] = '@KitSoft.Pages.Behaviors.ContentHandlerModel';

            $model->belongsToMany['authors'] = [
                'KitSoft\RLBlogXT\Models\Author',
                'table' => 'kitsoft_rlblogxt_posts_authors',
                'order' => 'name'
            ];

            $model->attachOne['og_image'] = [
                'System\Models\File',
                'order' => 'sort_order',
            ];

            $model->attachMany['featured_images'][0] = 'KitSoft\Pages\Models\SystemFile';

            $model->addHidden($this->hiddenFields);

            $model->addDynamicMethod('getContentHandlerFieldsAttribute', function () {
                return ['content'];
            });

            // getNext
            $model->addDynamicMethod('getNext', function () use ($model) {
                return $model::where('published_at', '>', $model->published_at)
                    ->where('id', '<>', $model->id)
                    ->orderBy('published_at', 'asc')
                    ->isPublished()
                    ->first();
            });

            // getPrev
            $model->addDynamicMethod('getPrev', function () use ($model) {
                return $model::where('published_at', '<', $model->published_at)
                    ->where('id', '<>', $model->id)
                    ->orderBy('published_at', 'desc')
                    ->isPublished()
                    ->first();
            });

            // getOtherNewsByTag
            $model->addDynamicMethod('getOtherNewsByTag', function ($limit = 7) use ($model) {
                if (!count($model->tags)) {
                    return;
                }
                return Post::isPublished()
                    ->with('featured_images', 'tags')
                    ->where('id', '<>', $model->id)
                    ->filterTags($model->tags->lists('id'))
                    ->orderBy('published_at', 'desc')
                    ->limit($limit)
                    ->get();
            });

            // scopeIsPublishedOrPreview
            $model->addDynamicMethod('scopeIsPublishedOrPreview', function ($query) {
                if (BackendPreview::isValidPreview() && Settings::get('show_all_posts')) {
                    return $query;
                }

                return $query->isPublished();
            });
        }, 5);
    }

    /**
     * configurateMultimediaFinder
     */
    protected function configurateMultimediaFinder(&$widget)
    {
        if (!Helpers::isMultimediaFinderEnabled()) {
            return;
        }

        $widget->secondaryTabs['fields']['featured_images'] = [
            'label' => 'rainlab.blog::lang.post.featured_images',
            'tab' => 'rainlab.blog::lang.post.tab_manage',
            'type' => 'multimediafinder'
        ];
    }

    /**
     * extendPostsController
     */
    protected function extendPostsController()
    {
        Posts::extendFormFields(function ($form, $model, $context) {
            if (!$model instanceof Post) {
                return;
            }

            if (!$context) {
                return;
            }

            $form->removeField('published');
            $form->removeField('published_at');
            $form->removeField('excerpt');
            $form->removeField('featured_images');

            $featuredImages = $form->secondaryTabs['fields']['featured_images'];
            $excerpt = $form->secondaryTabs['fields']['excerpt'];

            $form->addFields([
                'preview_button@update' => [
                    'label' => '',
                    'type' => 'partial',
                    'path' => '~/plugins/kitsoft/rlblogxt/controllers/posts/_preview_button.htm',
                    'tab' => 'rainlab.blog::lang.post.tab_manage',
                    'span' => 'auto'
                ],
            ]);

            $form->addSecondaryTabFields([
                'published_at' => [
                    'tab' => 'rainlab.blog::lang.post.tab_manage',
                    'label' => 'rainlab.blog::lang.post.published_on',
                    'span' => 'left',
                    'cssClass' => 'checkbox-align',
                    'type' => 'datepicker',
                    'mode' => 'datetime',
                    'default' => 'now',
                    'required' => 'true',
                    'trigger' => [
                        'action' => 'enable',
                        'field' => 'published',
                        'condition' => 'checked',
                    ]
                ],
                'published' => [
                    'tab' => 'rainlab.blog::lang.post.tab_manage',
                    'label' => 'rainlab.blog::lang.post.published',
                    'span' => 'right',
                    'type' => 'checkbox',
                    'default' => false,
                ],
                'is_top' => [
                    'label' => 'kitsoft.rlblogxt::lang.posts.top',
                    'type' => 'checkbox',
                    'span' => 'right',
                    'tab' => 'rainlab.blog::lang.post.tab_manage',
                ],
                'is_fixed' => [
                    'label' => 'kitsoft.rlblogxt::lang.posts.fixed',
                    'type' => 'checkbox',
                    'span' => 'right',
                    'tab' => 'rainlab.blog::lang.post.tab_manage',
                ],
                'is_author_visible' => [
                    'label' => 'kitsoft.rlblogxt::lang.post.is_author_visible',
                    'type' => 'checkbox',
                    'span' => 'right',
                    'default' => true,
                    'tab' => 'rainlab.blog::lang.post.tab_manage',
                ],
                'excerpt' => $excerpt,
                'featured_images' => $featuredImages,
                'authors' => [
                    'label' => 'kitsoft.rlblogxt::lang.post.authors',
                    'type' => 'taglist',
                    'mode' => 'relation',
                    'customTags' => false,
                    'tab' => 'rainlab.blog::lang.post.tab_manage',
                ],
                'meta_title' => [
                    'tab' => 'kitsoft.rlblogxt::lang.tab.seo',
                    'label' => 'kitsoft.rlblogxt::lang.post.seo.meta_title',
                ],
                'meta_h1' => [
                    'tab' => 'kitsoft.rlblogxt::lang.tab.seo',
                    'label' => 'kitsoft.rlblogxt::lang.post.seo.meta_h1',
                ],
                'meta_description' => [
                    'tab' => 'kitsoft.rlblogxt::lang.tab.seo',
                    'label' => 'kitsoft.rlblogxt::lang.post.seo.meta_description',
                ],
                'meta_keywords' => [
                    'tab' => 'kitsoft.rlblogxt::lang.tab.seo',
                    'label' => 'kitsoft.rlblogxt::lang.post.seo.meta_keywords',
                ],
                'og_image' => [
                    'tab' => 'kitsoft.rlblogxt::lang.tab.seo',
                    'label' => 'kitsoft.rlblogxt::lang.post.seo.og_image',
                    'type' => 'fileupload',
                ]
            ]);
        });

        Posts::extendListColumns(function ($list, $model) {
            if (!$model instanceof Post) {
                return;
            }

            $list->addColumns([
                'authors' => [
                    'label' => 'kitsoft.rlblogxt::lang.post.author',
                    'relation' => 'authors',
                    'select' => 'name',
                    'searchable' => 'true',
                ],
                'published_at' => [
                    'label' => 'rainlab.blog::lang.post.published',
                    'type' => 'datetime',
                    'searchable' => 'true',
                ],
                'is_fixed' => [
                    'label' => 'kitsoft.rlblogxt::lang.posts.fixed',
                    'type' => 'switch',
                    'searchable' => 'true',
                ],
                'is_top' => [
                    'label' => 'kitsoft.rlblogxt::lang.posts.top',
                    'type' => 'switch',
                    'searchable' => 'true',
                ],
                'regular' => [
                    'label' => 'kitsoft.rlblogxt::lang.posts.regular',
                    'type' => 'switch',
                    'select' => 'not is_fixed and not is_top',
                ],
                'hits' => [
                    'label' => 'kitsoft.rlblogxt::lang.posts.hits',
                    'type' => 'number',
                ]
            ]);
        });
    }
}
