<?php namespace KitSoft\RLBlogXT\Models;

use Model;

class Author extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\NestedTree;

    public $table = 'kitsoft_rlblogxt_authors';
    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
    ];

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required|max:191',
        'slug' => 'required|between:3,64|unique:kitsoft_rlblogxt_authors',
    ];

    protected $guarded = [];

    protected $hidden = ['pivot', 'nest_left', 'nest_right', 'nest_depth', 'code'];

    public $belongsToMany = [
        'posts' => ['RainLab\Blog\Models\Post',
            'table' => 'kitsoft_rlblogxt_posts_authors',
            'order' => 'published_at desc',
            'scope' => 'isPublished'
        ]
    ];

    /**
     * getPostCountAttribute
     */
    public function getPostCountAttribute()
    {
        return $this->posts()->count();
    }
}
