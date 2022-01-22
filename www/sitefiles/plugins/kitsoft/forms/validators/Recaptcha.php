<?php namespace KitSoft\Forms\Validators;

use Db;
use Request;
use ReCaptcha\ReCaptcha as GoogleRecaptcha;
use KitSoft\Forms\Models\Settings;

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
    	return 'Invalid captcha.';
    }
}
