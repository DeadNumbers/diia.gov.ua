<?php namespace KitSoft\Diia\Validators;

use Db;
use Request;
use KitSoft\Forms\Models\Settings;
use ReCaptcha\ReCaptcha as GoogleRecaptcha;

class Recaptcha
{
	/**
     * recaptcha
     */
    public function recaptcha($attribute, $value)
    {
        $recaptcha = new GoogleRecaptcha( Settings::get('secret_key') );

        /**
         * Verify the reponse, pass user's IP address
         */
        $response = $recaptcha->verify(
            $value,
            Request::ip()
        );

        return $response->isSuccess()
            ? true
            : false;
    }

    /**
     * Error message
     */
    public function recaptchaMessage($message, $attribute, $rule, $parameters)
    {
    	return 'Перезавантажте будь ласка сторінку та спробуйте ще раз';
    }
}