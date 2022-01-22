<?php namespace KitSoft\RLBlogXT\Extensions;

use Event;
use KitSoft\TagsManager\Models\Tag;
use RainLab\Blog\Controllers\Categories;
use RainLab\Blog\Models\Category;

class BlogCategoryExtension
{
    protected $hiddenFields = [
        'pivot',
        'fields',
        'nest_left',
        'nest_right',
        'nest_depth',
        'code',
        'favourite'
    ];

    /*
     * Construct
     */
    public function __construct()
    {
        $this->extendCategoriesModel();
        $this->extendCategoriesController();
    }

    /**
     * extendCategoriesModel
     */
    protected function extendCategoriesModel()
    {
        Category::extend(function ($model) {
            $model->addJsonable('fields');
            $model->addHidden($this->hiddenFields);

            $model->implement[] = '@KitSoft.Pages.Behaviors.RelationFinderModel';

            $model->addDynamicMethod('getRelationFinderConfig', function () {
                return ['nameFrom' => 'name'];
            });

            $model->addDynamicMethod('getTagListAttribute', function () use ($model) {
                return Tag::make()
                    ->whereHas('posts', function ($query) use ($model) {
                        return $query->isPublished()->filterCategories([$model->id]);
                    })
                    ->orderBy('name')
                    ->lists('name', 'id');
            });

            $model->rules['name'] = 'required|max:191';
        });
    }

    /**
     * extendCategoriesController
     */
    protected function extendCategoriesController()
    {
        Categories::extendFormFields(function ($form, $model, $context) {
            if (!$model instanceof Category) {
                return;
            }

            $form->addFields([
                'favourite' => [
                    'label' => 'kitsoft.rlblogxt::lang.category.favourite',
                    'type' => 'checkbox',
                    'default' => true
                ]
            ]);
        });
    }
}
