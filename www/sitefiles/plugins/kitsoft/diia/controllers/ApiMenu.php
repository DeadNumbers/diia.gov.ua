<?php namespace KitSoft\Diia\Controllers;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;
use KitSoft\Diia\Middlewares\CorsMiddleware;
use KitSoft\Pages\Models\Menu;
use October\Rain\Database\Collection;

class ApiMenu extends Controller
{
    /**
     * __construct
     */
    public function __construct()
    {
        $this->middleware(CorsMiddleware::class);
    }

    /**
     * show
     */
    public function show(string $slug)
    {
        try {
            $menu = Menu::where('code', $slug)
                ->firstOrFail();

            $menu->attributes['items'] = $menu->preparedItemsTree;

            unset($menu->id, $menu->created_at, $menu->updated_at);

            $menuItems = (array)$menu->items;
            $result = $this->excludeHiddenItems($menuItems);

        } catch (ModelNotFoundException $e) {
            return response()->json('Not found', 404);
        } catch (Exception $e) {
            trace_log($e);
            return response()->json('Something was wrong.', 500);
        }

        return response()->json([
            'name'  => $menu->name,
            'code'  => $menu->code,
            'items' => $result
        ]);
    }

    /**
     * excludeHiddenItems
     */
    public function excludeHiddenItems(array $menu)
    {
        foreach ($menu as $key=>&$item) {
            if ($item['isHidden'] == true) {
                unset($menu[$key]);
            } else {
                if ($item['items'] != null) {
                    $item['items'] = $this->excludeHiddenItems($item['items']);
                }
            }
        }

        return array_values($menu);
    }
}