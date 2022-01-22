<?php namespace KitSoft\Diia\Controllers;

use KitSoft\Diia\Classes\HealthApi;
use Request;
use Exception;
use Validator;

class ApiHealth
{
    /**
     * health
     */
    public function health()
    {
        $data = request()->all();

        $messages = [
            'medicDokNumb.required' => 'Поле Номер медичного висновку про тимчасову непрацездатність обов\'язкове для заповнення',
            'rnokpp.numeric' => 'Поле РНОКПП має бути числом',
            'rnokpp.digits' => 'Довжина числового поля РНОКПП повинна бути 10',
            'series.size' => 'Довжина поля Серія паспорту повинна бути 2',
            'number.digits' => 'Довжина числового поля Номер паспорту повинна бути 6',
            'number.numeric' => 'Поле Номер паспорту має бути числом',
            'g-recaptcha-response.required' => 'Поле reCAPTCHA обов\'язкове для заповнення',
            'g-recaptcha-response.recaptcha' => 'Перезавантажте будь ласка сторінку та спробуйте ще раз',
        ];

        $validator = Validator::make($data, [
            'medicDokNumb' => 'required',
            'number' => 'numeric|digits:6',
            'rnokpp' => 'numeric|digits:10',
            'series' => 'size:2',
            'g-recaptcha-response' => 'required|recaptcha'
        ], $messages);

        $request['medicDokNumb'] = $data['medicDokNumb'];

        if (isset($data['rnokpp'])) {
            $request['rnokpp'] = $data['rnokpp'];
        }

        if (isset($data['identityDocNumb']) and $data['identityTypeID'] == 1) {
            $request['identityDocNumb'] = $data['identityDocNumb'];
            $request['identityTypeID'] = $data['identityTypeID'];
        }

        if (isset($data['userId'])) {
            $request['userId'] = $data['userId'];
        }

        if (isset($data['series']) and isset($data['number']) and $data['identityTypeID'] == 1) {
            $request['identityDocNumb'] = $data['series'] . $data['number'];
            $request['identityTypeID'] = $data['identityTypeID'];
        }

        if (isset($data['passportTypeID']) and $data['identityTypeID'] == 7) {
            $request['identityDocNumb'] = $data['passportTypeID'];
            $request['identityTypeID'] = $data['identityTypeID'];
        }

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $data = healthApi::instance()->request($request);

            return response()->json($data);

        } catch (Exception $e) {
            trace_log($e);
            return response()->json($e->getMessage(), 400);
        }
    }
}
