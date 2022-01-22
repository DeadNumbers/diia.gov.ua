<?php namespace KitSoft\RLBlogXT\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use October\Rain\Argon\Argon;
use RainLab\Blog\Models\Post;
use ValidationException;
use Validator;

class ApiNewsController extends Controller
{
	protected $defaultPerPage = 10;

	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->middleware('KitSoft\RLBlogXT\Middlewares\TrustProxiesMiddleware');
        $this->middleware('KitSoft\RLBlogXT\Middlewares\AllowedIpsMiddleware');
	}

	/**
	 * index
	 */
	public function index()
	{
		$data = request()->all();

        $validator = Validator::make($data, [
            'per_page' => 'int|between:1,100',
            'from' => 'date',
            'to' => 'date'
        ]);

        if ($validator->fails()) {
        	return response()->json($validator->errors(), 422);
        }

        try {
        	$query = Post::isPublished()
        		->with('categories', 'tags', 'featured_images', 'authors')
        		->orderBy('published_at', 'desc');

        	// from filter
        	if (isset($data['from'])) {
        		$query = $query->where('updated_at', '>=', Argon::parse($data['from']));
        	}

        	// to filter
        	if (isset($data['to'])) {
        		$query = $query->where('updated_at', '<=', Argon::parse($data['to']));
        	}

        	$items = $query->paginate($data['per_page'] ?? $this->defaultPerPage)
        		->appends($data);
        } catch (Exception $e) {
        	trace_log($e);
        	return response()->json(['error'], 503);
        }

        return response()->json($items);
	}
}