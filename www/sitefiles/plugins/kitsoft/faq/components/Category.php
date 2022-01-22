<?php namespace KitSoft\Faq\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Faq\Models\Category as CategoryModel;
use KitSoft\Faq\Models\Question;

class Category extends ComponentBase
{
    public $category;
    public $questions;
    protected $defaultPerPage = 10;

    public function componentDetails()
    {
        return [
            'name'        => 'Категорія',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'perPage' => [
                'title' => 'Per page',
                'default' => $this->defaultPerPage,
                'required' => true,
                'type' => 'dropdown',
                'options' => array_combine($range = range(1, 100), $range),
            ]
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        if (!$this->category = $this->loadCategory()){
            $this->setStatusCode('404');
            return $this->controller->run('404');
        }
        $this->questions = $this->loadQuestions();
    }

    /**
     * loadCategory
     */
    protected function loadCategory()
    {
        return CategoryModel::where('slug', $this->param('slug'))
            ->first();
    }

    /**
     * loadQuestions
     */
    protected function loadQuestions()
    {
        return Question::isPublished()
            ->whereHas('categories', function ($query) {
                return $query->whereIn('id', $this->category->getAllChildrenAndSelf()->lists('id'));
            })
            ->paginate($this->property('perPage') ?? $this->defaultPerPage);
    }
}
