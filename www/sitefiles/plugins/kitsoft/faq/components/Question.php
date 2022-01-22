<?php namespace KitSoft\Faq\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Faq\Models\Question as QuestionModel;

class Question extends ComponentBase
{
    public $question;

    public function componentDetails()
    {
        return [
            'name'        => 'Запитання',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        if (!$this->question = $this->loadQuestion()){
            $this->setStatusCode('404');
            return $this->controller->run('404');
        }
    }

    /**
     * loadQuestion
     */
    public function loadQuestion()
    {
        return QuestionModel::isPublished()
            ->with(['related_questions' => function ($query) {
                return $query->isPublished();
            }])
            ->find($this->param('id'));
    }
}
