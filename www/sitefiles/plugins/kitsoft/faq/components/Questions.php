<?php namespace KitSoft\Faq\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Faq\Models\Question;

class Questions extends ComponentBase
{
    public $items;
    
    protected $defaultPerPage = 12;

    public function componentDetails()
    {
        return [
            'name'        => 'Каталог запитань',
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
            ],
            'isTopFilter' => [
                'title' => 'Тільки закріплені',
                'type' => 'checkbox',
                'group' => 'Сервіси',
            ],
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->items = $this->loadQuestions();
    }

    /**
     * loadQuestions
     */
    protected function loadQuestions()
    {
        $query = Question::isPublished();

        if ($this->property('isTopFilter')) {
            $query = $query->isTop();
        }

        return $query->orderBy('created_at', 'desc')
            ->paginate($this->property('perPage') ?? $this->defaultPerPage);
    }
}
