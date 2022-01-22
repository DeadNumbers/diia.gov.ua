<?php namespace KitSoft\Pages\Controllers;

use Backend\Facades\BackendAuth;
use Illuminate\Routing\Controller;
use KitSoft\Pages\Classes\PagesHelper;
use ValidationException;
use Validator;

class ApiBackend extends Controller
{
	use \System\Traits\ViewMaker;

	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->middleware('web');
        $this->middleware('KitSoft\Pages\Middlewares\BackendAuthMiddleware');
	}

	/**
	 * toolbar
	 */
	public function toolbar()
	{
		$data = request()->all();

        $validator = Validator::make($data, [
            'hash' => 'string'
        ]);

        if ($validator->fails()) {
        	return response()->json($validator->errors(), 422);
        }

        try {
        	$editUrl = (isset($data['hash']) && !empty($data['hash']))
        		? PagesHelper::getModelEditUrl($data['hash'])
        		: null;
        } catch (Exception $e) {
        	trace_log($e);
        	return response()->json(['error'], 503);
        }

        return $this->makePartial('toolbar', [
        	'user' => BackendAuth::getUser(),
        	'edit_url' => $editUrl
        ]);
	}
}