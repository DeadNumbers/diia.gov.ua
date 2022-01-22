<?php namespace KitSoft\Faq\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Faq\Models\Category;
use KitSoft\Faq\Models\Question;

class Categories extends ComponentBase
{
    public $categories;
    public $mainLabel;
    public $askLabel;
    public $questions;

    public function componentDetails()
    {
        return [
            'name'        => 'Категорії',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'mainLabel' => [
                'title' => 'Заголовок',
                'group' => 'Головне',
            ],
            'askLabel' => [
                'title' => 'Надпис "Задати питання"',
                'group' => 'Головне',
            ],
            'countQuestions' => [
                'title' => 'Кількість запитань в категорії',
                'required' => true,
                'type' => 'dropdown',
                'group' => 'Головне',
                'emptyOption' => 'Усі',
                'options' => array_combine($range = range(0, 20), $range),
                'span' => 'left'
            ],
            'isTopFilter' => [
                'title' => 'Тільки закріплені категорії',
                'type' => 'checkbox',
                'group' => 'Головне',
                'span' => 'left'
            ],
            'isTopQuestionsFilter' => [
                'title' => 'Тільки закріплені запитання',
                'type' => 'checkbox',
                'group' => 'Головне',
                'span' => 'left'
            ],
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->categories = $this->loadCategories();
        $this->mainLabel = $this->property('mainLabel');
        $this->askLabel = $this->property('askLabel');
        $this->questions = $this->loadQuestions();
    }

    /**
     * loadCategories
     */
    protected function loadCategories()
    {
        $query = Category::make();

        if ($this->property('isTopFilter')) {
            $query = $query->isTop();
        }

        return $query->whereHas('questions', function ($query) {
                return $query->isPublished();
            })
            ->getAllRoot()
            ->each(function ($item) {
                $this->loadCategoryQuestions($item);
            });
    }

    /**
     * loadCategoryQuestions
     */
    protected function loadCategoryQuestions(Category &$category)
    {
        $category->load(['questions' => function ($query) {
            if ($this->property('isTopQuestionsFilter')) {
                $query = $query->isTop();
            }
            if ($count = $this->property('countQuestions')) {
                $query = $query->limit($count);
            }
            return $query->isPublished()
                ->orderBy('question');
        }]);
    }

    /**
     * loadQuestions
     */
    protected function loadQuestions()
    {
        return Question::isPublished()->filterWithoutCategories()->get();
    }
}