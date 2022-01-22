<?php namespace KitSoft\Faq\Updates;

use KitSoft\Forms\Models\Field;
use KitSoft\Forms\Models\Form;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class SeedFaqForm extends Migration
{
    public function up()
    {
        $form = Form::make();
        $form->name = 'Задати запитання';
        $form->code = 'faq';
        $form->is_system = true;
        $form->success_text = '<p>Успішно відправлено</p>';
        $form->send = false;
        $form->submit_text = 'Відправити';
        $form->save();

        $field = Field::make();
        $field->form_id = $form->id;
        $field->title = 'Ім\'я';
        $field->code = 'name';
        $field->type = 'text';
        $field->placeholder = 'Введіть ім\'я';
        $field->sort_order = 1;
        $field->save();

        $field = Field::make();
        $field->form_id = $form->id;
        $field->title = 'Email';
        $field->code = 'email';
        $field->type = 'text';
        $field->placeholder = 'Введіть email';
        $field->rules = ['required', 'email'];
        $field->sort_order = 2;
        $field->save();

        $field = Field::make();
        $field->form_id = $form->id;
        $field->title = 'Установа';
        $field->code = 'company';
        $field->type = 'text';
        $field->placeholder = 'Введіть назву установи';
        $field->sort_order = 3;
        $field->save();

        $field = Field::make();
        $field->form_id = $form->id;
        $field->title = 'Запитання';
        $field->code = 'question';
        $field->type = 'textarea';
        $field->placeholder = '';
        $field->rules = ['required'];
        $field->sort_order = 5;
        $field->save();

        $field = Field::make();
        $field->form_id = $form->id;
        $field->title = 'Коментарій';
        $field->code = 'comment';
        $field->type = 'textarea';
        $field->placeholder = '';
        $field->sort_order = 6;
        $field->save();

        $field = Field::make();
        $field->form_id = $form->id;
        $field->title = 'Recaptcha';
        $field->type = 'recaptcha';
        $field->sort_order = 7;
        $field->save();
    }

    public function down()
    {
        
    }
}
