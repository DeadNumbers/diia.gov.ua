<?php namespace KitSoft\RLBlogXT\Extensions;

use Event;
use Rainlab\Blog\Models\Post;
use RainLab\Blog\Controllers\Posts;

class PostsListExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
        Event::listen('backend.list.extendQuery', function ($widget, $query) {
            if (!$widget->model instanceof Post) {
                return;
            }
            $this->extendQueryOrder($query);
        });

        Event::listen('backend.filter.extendScopes', function ($widget) {
            if (!$widget->getController() instanceof Posts) {
                return;
            }
            $this->extendFilters($widget);
        });
    }

    /**
     * extendQueryOrder
     */
    protected function extendQueryOrder(&$query)
    {
        $orders = $query->getQuery()->orders;

        if (!isset($orders) || count($orders) !== 1) {
            return;
        }

        if (!isset($orders[0], $orders[0]['column'])) {
            return;
        }

        switch ($orders[0]['column']) {
            case 'is_top':
            case 'is_fixed':
                $query = $query->orderBy('published_at', 'desc');
                break;
        }
    }

    /**
     * extendFilters
     */
    protected function extendFilters(&$widget)
    {
        $widget->addScopes([
            'published_date' => [
                'label' => 'rainlab.blog::lang.posts.filter_date',
                'type' => 'daterange',
                'conditions' => "published_at >= ':after' AND published_at <= ':before'",
            ]
        ]);
    }
}
