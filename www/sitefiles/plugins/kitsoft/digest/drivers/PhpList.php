<?php namespace KitSoft\Digest\Drivers;

use Config;
use Event;
use Exception;
use Flash;
use KitSoft\Digest\Classes\PhpListAdapter;
use KitSoft\Digest\Models\ListSync;
use KitSoft\Digest\Models\Settings;
use System\Controllers\Settings as SettingsController;

class PhpList
{	
	/**
	 * __construct
	 */
	public function __construct()
	{
		Event::listen('kitsoft.digest::subscriber.create', function ($subscriber) {
			$this->subscribe($subscriber);
		});

		Event::listen('kitsoft.digest::subscriber.afterSave', function ($subscriber) {
			$this->subscriberAfterSave($subscriber);
		});

		Event::listen('kitsoft.digest::listssync.extendForm', function ($form, $fields) {
			$this->extendListsSyncForm($form, $fields);
		});

		Event::listen('kitsoft.digest::subscriber.afterDelete', function ($subscriber) {
			$this->subscriberAfterDelete($subscriber);
		});

		Event::listen('kitsoft.digest::listssync.exportLists', function () {
			$this->exportListsAndCampaigns();
		});

		Event::listen('kitsoft.digest::listssync.afterRenderBackendIndex', function () {
			echo view('kitsoft.digest::listsFaq', [
				'driverUrl' => Settings::get('phplist.apiUrl')
			]);
		});

		Event::listen('kitsoft.digest::template.beforeOnRun', function () {
			if (request()->get('uuid') == '[uniqid]') {
				die;
			}
		});

		SettingsController::extend(function($controller) {
	        $controller->addDynamicMethod('onCheckApiConnection', function() {
	        	try {
	        		PhpListAdapter::instance();
	        	} catch (Exception $e) {
	        		Flash::error('Connection fail');
	        		return;
	        	}
	            
	            Flash::success('Connection success');
	        });
	    });
	}

	/**
	 * subscribe
	 */
	protected function subscribe($subscriber)
	{
		if (!$response = PhpListAdapter::instance()->subscriberFindByEmail($subscriber->email)) {
			$response = PhpListAdapter::instance()->subscriberAdd([
				'email' => $subscriber->email,
				'disabled' => 0,
				'confirmed' => $subscriber->confirmed ? 1 : 0,
				'foreignkey' => '',
				'htmlemail' => 1
			]);
		}

		try {
			if (isset($response->code) && $response->code == 0) {
				throw new Exception($response->message);
			}
			
			if ($subscriber->sync_id !== $response->id || $subscriber->sync_uuid !== $response->uniqid) {
				$subscriber->sync_id = $response->id;
				$subscriber->sync_uuid = $response->uniqid;
				$subscriber->save();
			}
		} catch (Exception $e) {
			trace_log('PhpList Subscribe error. Response: ' . json_encode($response));
			Flash::success($e->getMessage());
		}

		return $subscriber;
	}

	/**
	 * subscriberAfterSave
	 * sync subscriber with phpList 
	 * remove not checked and add checked lists
	 */
	protected function subscriberAfterSave($subscriber)
	{
		$subscriber = $this->subscribe($subscriber);
		
		if (!$subscriber->sync_id) {
			return;
		}

		// confirm email
		if (!$subscriber->getOriginal('confirmed') && $subscriber->confirmed) {
			PhpListAdapter::instance()->subscriberUpdate($subscriber->sync_id, [
				'email' => $subscriber->email,
				'disabled' => 0,
				'confirmed' => 1,
				'foreignkey' => '',
				'htmlemail' => 1
			]);
		}
		
		// get subscriber lists
		$currentLists = PhpListAdapter::instance()
			->listsSubscriber($subscriber->sync_id);
		
		// remove
		collect($currentLists)->each(function ($item) use ($subscriber) {
			if (!$subscriber->lists->where('sync_id', $item->id)->count()) {
				PhpListAdapter::instance()
					->listSubscriberDelete($item->id, $subscriber->sync_id);
			}
		});

		// sync
		$subscriber->lists->each(function ($list) use ($subscriber) {
			PhpListAdapter::instance()
				->listSubscriberAdd($list->sync_id, $subscriber->sync_id);
		});
	}

	/**
	 * extendListsSyncForm
	 * Lists controller. Set options for sync_id dropdown
	 */
	protected function extendListsSyncForm($form, $fields)
	{
		$lists = PhpListAdapter::instance()
			->getListsCollection()
			->transform(function ($item) {
				$item->title = "{$item->name} ({$item->description})";
				return $item;
			})
			->lists('title', 'id');

		$fields['sync_id']->type = 'dropdown';
		$fields['sync_id']->span = 'auto';
		$fields['sync_id']->options = array_prepend($lists, '-- Select List Id --', '');

	}

	/**
	 * subscriberAfterDelete
	 */
	protected function subscriberAfterDelete($subscriber)
	{
		PhpListAdapter::instance()
			->subscriberDelete($subscriber->sync_id);
	}

	/**
	 * exportListsAndCampaigns
	 * create lists & campaigns in phplist, with relations
	 */
	protected function exportListsAndCampaigns()
	{
		$lists = PhpListAdapter::instance()
			->getListsCollection();

		$campaigns = PhpListAdapter::instance()
			->getCampaignsCollection();

		ListSync::get()->each(function ($item) use ($lists, $campaigns) {

			$code = Config::get('app.name') . " {$item->code}";
			$title = Config::get('app.name') . " {$item->title}";

			// create list if not exist
			if (!$remoteList = $lists->where('name', $code)->first()) {
				$listId = PhpListAdapter::instance()->listAdd($code, $title);
				$item->sync_id = $listId;
				$item->save();
			} else {
				$listId = $remoteList->id;
			}
			
			// create campaign if not exist
			if (!$remoteCampaign = $campaigns->where('subject', $code)->first()) {
				$campaignId = PhpListAdapter::instance()->campaignAdd($code, [
					'subject' => $title,
		            'message' => '[URL:' . url('digest/template?uuid=[uniqid]&period=MINUTES') . ']',
		            'status' => 'draft',
		            'sendformat' => 'HTML',
		            'embargo' => date('Y-m-d H:i:s'),
		            'owner' => 1,
				]);
			} else {
				$campaignId = $remoteCampaign->id;
			}

			// sync list with campaign
			PhpListAdapter::instance()->listCampaignAdd($listId, $campaignId);
		});
	}
}