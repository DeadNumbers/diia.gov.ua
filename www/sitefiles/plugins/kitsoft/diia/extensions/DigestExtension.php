<?php namespace KitSoft\Diia\Extensions;

use Config;
use Event;
use Exception;
use MailerLiteApi\MailerLite;

class DigestExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
    	$this->subscriberAfterCreateSendTOMailerlite();
    }

    /**
     * subscriberAfterCreateSendToMailerlite
     */
    protected function subscriberAfterCreateSendToMailerlite()
    {
        Event::listen('kitsoft.digest::subscriber.create', function ($subscriber) {
            try {
                $apiKey = Config::get('kitsoft.diia::mailerlite.api_key');
                $groupId = Config::get('kitsoft.diia::mailerlite.group_id');

                $mailerLite = new MailerLite($apiKey);

                $response = $mailerLite->groups()->addSubscriber($groupId, [
                    'email' => $subscriber->email
                ]);

                if (isset($response->error)) {
                    throw new Exception('MailerLite add subscriber error! ' . json_encode($response));
                }

                if (!isset($response->id, $response->email)) {
                    throw new Exception('MailerLite add subscriber error! ' . json_encode($response));
                }
            } catch (Exception $e) {
                trace_log($e);
                return;
            }
        });
    }
}
