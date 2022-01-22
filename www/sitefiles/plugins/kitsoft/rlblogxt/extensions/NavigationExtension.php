<?php namespace KitSoft\RLBlogXT\Extensions;

use Event;
use Backend;

class NavigationExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
        Event::listen('backend.menu.extendItems', function ($manager) {
            $manager->addSideMenuItems('RainLab.Blog', 'blog', [
                'authors' => [
                    'label' => 'kitsoft.rlblogxt::lang.authors.labels.menu_label',
                    'icon' => 'icon-users',
                    'code' => 'mysidemenuitem',
                    'owner' => 'KitSoft.RLBlogXT',
                    'permissions' => ['kitsoft.rlblogxt.access_authors'],
                    'url' => Backend::url('kitsoft/rlblogxt/authors'),
                ],
            ]);
        });
    }
}
