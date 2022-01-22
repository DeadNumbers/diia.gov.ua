<?php namespace KitSoft\Search\Providers\Eloquent;

use KitSoft\Search\Providers\Eloquent\Provider;

class MediaGalleriesProvider extends Provider
{
    protected $filters = ['key', 'tags', 'type', 'from', 'to'];

    /**
     * applyTagsFilter
     */
    protected function applyTagsFilter()
    {
        if ($data = request()->tags) {
            $this->query->filterTags(explode(',', $data), 'slug');
        }
    }
}
