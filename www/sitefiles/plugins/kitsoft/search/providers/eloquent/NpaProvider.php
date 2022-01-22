<?php namespace KitSoft\Search\Providers\Eloquent;

use Config;
use Illuminate\Http\Request;
use KitSoft\NPA\Models\Act;
use KitSoft\Search\Providers\Eloquent\Provider;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use October\Rain\Argon\Argon;

class NpaProvider extends Provider
{
    protected $filters = [
        'key',
        'num',
        'category',
        'tags',
        'type',
        'status',
        'session',
        'convocation',
        'from',
        'to'
    ];

    /**
     * prepareItem
     */
    protected function prepareItem($item)
    {
        $item->attributes['categoryName'] = $item->category ? $item->category->name : null;

        if (Config::get('kitsoft.npa::enableActsSessions')) {
            $item->attributes['sessionName'] = $item->session ? $item->session->name : null;
        }
        
        if (Config::get('kitsoft.npa::enableActsSessions')) {
            $item->attributes['convocationName'] = $item->convocation ? $item->convocation->name : null;
        }

        unset($item->category, $item->category_id);
    }

    /**
     * applyFromFilter
     */
    protected function applyFromFilter()
    {
        if ($from = request()->from) {
            $this->query->whereDate('creation_date', '>=', Argon::parse($from));
        }
    }

    /**
     * applyToFilter
     */
    protected function applyToFilter()
    {
        if ($to = request()->to) {
            $this->query->whereDate('creation_date', '<=', Argon::parse($to));
        }
    }

    /**
     * applyNumFilter
     */
    protected function applyNumFilter()
    {
        if ($data = request()->num) {
            $this->query->where('no', 'ilike', "%{$data}%");
        }
    }

    /**
     * applyCategoryFilter
     */
    protected function applyCategoryFilter()
    {
        if ($data = request()->category) {
            $this->query->where('category_id', (int)$data);
        }
    }

    /**
     * applyTagsFilter
     */
    protected function applyTagsFilter()
    {
        if ($data = request()->tags) {
            $this->query->filterTags([$data], 'slug');
        }
    }

    /**
     * applyStatusFilter
     */
    protected function applyStatusFilter()
    {
        if ($data = request()->status) {
            $this->query->whereHas('status', function ($query) use ($data) {
                return $query->where('slug', $data);
            });
        }
    }

    /**
     * applySessionFilter
     */
    protected function applySessionFilter()
    {
        if ($data = request()->session) {
            $this->query->where('session_id', (int)$data);
        }
    }

    /**
     * applyConvocationFilter
     */
    protected function applyConvocationFilter()
    {
        if ($data = request()->convocation) {
            $this->query->where('convocation_id', (int)$data);
        }
    }
}
