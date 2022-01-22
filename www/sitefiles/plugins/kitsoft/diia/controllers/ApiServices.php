<?php namespace KitSoft\Diia\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use KitSoft\Diia\Middlewares\CorsMiddleware;
use KitSoft\Pages\Models\Page;
use KitSoft\Services\Models\Category;

class ApiServices extends Controller
{
    /**
     * __construct
     */
    public function __construct()
    {
        $this->middleware(CorsMiddleware::class);
    }

	/**
     * categories
     */
    public function categories()
    {
        try {
            $service = Page::isPublished()
                ->where('layout', 'services')
                ->first();

            $categories = Category::isTop()
                ->with('subcategories')
                ->get()
                ->filter(function ($item) {
                    return (bool)$item->subcategoriesTree->count();
                })
                ->transform(function ($category) use ($service) {
                    return [
                        'name' => $category->name,
                        'slug' => $category->slug,
                        'items' => $category->subcategoriesTree->transform(function ($item) use ($category) {
                            return [
                                'name' => $item->name,
                                'slug' => $item->slug,
                                'url' => $item->getFullUrl($category)
                            ];
                        })->values()
                    ];
                });
        } catch (Exception $e) {
            trace_log($e);
            return response()->json('Something was wrong.', 500);
        }

        return response()->json($categories);
    }
}