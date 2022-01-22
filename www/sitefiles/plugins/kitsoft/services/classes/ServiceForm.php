<?php
namespace KitSoft\Services\Classes;

use App;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use KitSoft\Services\Models\Settings;
use Mail;
use Validator;
use ValidationException;

/**
 * service email form actions
 */
class ServiceForm
{
    /**
     * validate request
     * @param  Request $request [description]
     * @return Response
     */
    public function receive(Request $request)
    {
        $data = request()->only([
            'email',
            'name',
            'phone',
            'content',
            'service_name',
            'service_link',
        ]);

        $validator = Validator::make($data, [
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'nullable',
            'content' => 'required',
            'service_name' => 'required',
            'service_link' => 'required|url'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            $this->send($data);
        } catch (Exception $e) {
            return json_encode([
                'sent' => false,
                'error' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }

        return json_encode([
            'sent' => true,
            'error' => 0,
            'message' => ''
        ]);
    }

    /**
     * send email
     * @param  array $data validated data
     * @return bool       sended or not
     */
    public function send(array $data)
    {
        if (!$sendTo = Settings::get('serviceFormSendTo')) {
            trace_log('Services Form Email is not set.');
            throw new Exception('Error');
        }

        return Mail::sendTo($sendTo, 'kitsoft.services::services.service_form', $data);
    }
}