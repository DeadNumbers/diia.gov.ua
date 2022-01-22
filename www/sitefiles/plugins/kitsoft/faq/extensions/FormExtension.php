<?php namespace KitSoft\Faq\Extensions;

use Flash;
use Event;
use Exception;
use KitSoft\Faq\Models\Question;
use KitSoft\Forms\Controllers\Inboxes;
use KitSoft\Forms\Models\Inbox;

class FormExtension
{
	CONST FORM_CODE = 'faq';

	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->extendInboxController();
	}

	/**
	 * extendInboxController
	 */
	protected function extendInboxController()
	{
		// extend preview toolbar
		Event::listen('kitsoft.forms.inbox.preview', function ($controller) {
			if ($controller->widget->form->model->form->code == 'faq') {
				echo $controller->makePartial('$/kitsoft/faq/partials/_inbox_preview_toolbar.htm');
			}
		});

		// add ajax method
		Inboxes::extend(function ($controller) {
			$controller->addDynamicMethod('onMoveToQuestion', function ($id) {
				return $this->moveInboxToQuestion($id);
			});
		});
	}

	/**
	 * moveInboxToQuestion
	 */
	protected function moveInboxToQuestion($id)
	{
		$inbox = Inbox::find($id);

		try {
			$question = Question::make();
	    	$question->question = $inbox->fields['question'];
	    	$question->categories = (array)$inbox->fields['category_id'];
	    	$question->fields = [
	    		'inbox_id' => $id
	    	];
	    	$question->save();

	    } catch (Exception $e) {
	    	Flash::error($e->getMessage());
	    	trace_log($e);
	    	return;
	    }

	    Flash::success('Запитання успішно створено.');

    	return redirect()->to("/backend/kitsoft/faq/questions/update/{$question->id}");
	}
	
}