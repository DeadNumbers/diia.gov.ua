<?php namespace KitSoft\Digest\Components;

use Db;
use Mail;
use Cms\Classes\ComponentBase;
use KitSoft\Digest\Models\Subscriber;
use ValidationException;
use Validator;
use ApplicationException;
use Exception;

class Subscribe extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Subscribe',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    /**
     * onSubscribe
     */
    public function onSubscribe()
    {
        $data = request()->all();

        $validator = Validator::make($data, [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        Db::beginTransaction();
        try {
            $email = trim($data['email']);
            $email = strtolower($email);
            
            if (!$subscriber = Subscriber::whereEmail($email)->first()) {
                $subscriber = Subscriber::make();
                $subscriber->email = $email;
                $subscriber->save();
            }

            $mail = Mail::sendTo($subscriber->email, 'kitsoft.digest::subscribe', [
                'subscriber' => $subscriber
            ]);
        } catch (Exception $e) {
            Db::rollback();
            trace_log($e);
            throw new ApplicationException('Error. Please, try again later.');
        }
        Db::commit();
    }
}
