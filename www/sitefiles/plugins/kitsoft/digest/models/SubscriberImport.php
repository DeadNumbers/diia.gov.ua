<?php namespace KitSoft\Digest\Models;

use Backend\Models\ImportModel;
use Exception;
use KitSoft\Digest\Models\ListSync;
use KitSoft\Digest\Models\Subscriber;

/**
 * SubscriberImport Model
 */
class SubscriberImport extends ImportModel
{
    /**
     * @var array The rules to be applied to the data.
     */
    public $rules = [
        'email' => 'required|email'
    ];

    public function importData($results, $sessionKey = null)
    {
        foreach ($results as $row => $data) {
            $email = trim($data['email']);
            $email = strtolower($email);
            
            if (Subscriber::where('email', $email)->first()) {
                $this->logSkipped($row, "Email already exists [{$email}]");
                continue;
            }
            try {
                $subscriber = Subscriber::make();
                $subscriber->attributes = $data;
                $subscriber->content_types = $this->content_types ?? [];
                $subscriber->save();

                if (filter_var($subscriber->confirmed, FILTER_VALIDATE_BOOLEAN) && $this->list_id) {
                    $subscriber->lists = [
                        $this->list_id
                    ];
                    $subscriber->save();
                }

                $this->logCreated();
            }
            catch (Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }

    /**
     * getListsOptions
     */
    public function getListsOptions()
    {
        return ListSync::lists('title', 'id');
    }

    /**
     * getContentTypesOptions
     */
    public function getContentTypesOptions()
    {
        return Subscriber::make()->getContentTypesOptions();
    }
}
