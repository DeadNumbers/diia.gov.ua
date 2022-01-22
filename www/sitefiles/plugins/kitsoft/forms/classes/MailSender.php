<?php namespace KitSoft\Forms\Classes;

use KitSoft\Forms\Models\Inbox;
use Mail;
use System\Models\MailSetting;

class MailSender
{
    protected $inbox;
    protected $mailSettings;

    /**
     * __construct
     */
    public function __construct(Inbox $inbox)
    {
        $this->inbox = $inbox;
        $this->mailSettings = MailSetting::instance();
    }

    /**
     * send
     */
    public function send()
    {
        return Mail::send(
            // set email template
            $this->inbox->form->template->code,
            // set fields for email template
            ['fields' => $this->inbox->fields],
            function ($message) {
                // set emails
                $message->from($this->mailSettings->sender_email, $this->mailSettings->sender_name);
                $message->to(array_pluck($this->inbox->form->emails, 'email'));

                // attach files
                foreach ($this->inbox->files as $file) {
                    $message->attach($file->getLocalPath());
                }
            }
        );
    }
}
