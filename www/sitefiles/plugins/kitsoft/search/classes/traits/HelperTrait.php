<?php
namespace KitSoft\Search\Classes\Traits;

use Config;
use Carbon\Carbon;
use Illuminate\Http\Request;
use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Search\Models\Settings;
use KitSoft\Pages\Models\Settings as PagesSettings;

trait HelperTrait
{
    public $tagsKey = 'tag_slugs';

    /**
     * tyme name must be after last underscore
     * @param  string $indexName
     * @return string
     */
    public function getTypeFromIndexName(string $indexName): string
    {
        return substr($indexName, strrpos($indexName, '_') + 1);
    }

    /**
     * isValidPaginatorPage
     */
    protected function isValidPaginatorPage(Request $request)
    {
        if (!$maxItemsLimit = (int)Settings::get('elastic_max_items_limit')) {
            return true;
        }
        
        if ($request->has('per_page')) {
            $perPage = (int)$request->get('per_page');
        } else {
            $perPage = (int)Settings::get('elastic_per_page') ?? 5;
        }

        if (!$page = $request->get('page')) {
            return true;
        }

        $items = $page * $perPage;

        return ($items <= $maxItemsLimit);
    }
}
