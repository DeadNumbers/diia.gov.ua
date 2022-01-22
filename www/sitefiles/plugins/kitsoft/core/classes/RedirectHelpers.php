<?php namespace KitSoft\Core\Classes;

use Adrenth\Redirect\Models\Category;
use Adrenth\Redirect\Models\Redirect;
use KitSoft\Pages\Classes\PagesHelper;

class RedirectHelpers
{
    /**
     * createRedirect
    */
    public static function createRedirect(string $from, string $to, string $categoryName): Redirect
    {
        $from = self::removeHost($from);

        // return if already exist
        if ($redirect = Redirect::where('from_url', $from)->where('to_url', $to)->first()) {
            return $redirect;
        }

        // remove old redirects with source_url
        if ($redirects = Redirect::where('from_url', $from)->get()) {
            $redirects->each(function ($item) {
                $item->delete();
            });
        }

        if (!$category = Category::where('name', $categoryName)->first()) {
            $category = Category::make();
            $category->name = $categoryName;
            $category->save();
        }

        $redirect = Redirect::make();

        $redirect->match_type = 'exact';
        $redirect->from_url = $from;
        $redirect->to_url = $to;
        $redirect->status_code = 301;
        $redirect->is_enabled = true;
        $redirect->target_type = 'path_or_url';
        $redirect->test_lab_path = '';
        $redirect->category = $category->id;
        
        $redirect->save();

        return $redirect;
    }

    /**
     * removeHost
     */
    public static function removeHost(string $url): string
    {
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $host = parse_url($url, PHP_URL_HOST);

        return ($host)
            ? str_replace(($scheme ? "{$scheme}://" : '') . $host, '', $url)
            : $url;
    }
}