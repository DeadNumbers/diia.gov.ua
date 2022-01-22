<?php namespace KitSoft\TagsManager\Models;

use KitSoft\TagsManager\Twig\Functions;
use October\Rain\Database\Model;

class Tag extends Model
{
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    protected $hidden = ['locale', 'entity_id', 'relation_id', 'entity_type', 'site_id', 'pivot'];

    public $rules = [
        'name' => ['required', 'regex:/^[^,.]*$/i', 'max:191'],
        'slug' => ['max:191'],
    ];
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_tagsmanager_tags';

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
        '@KitSoft.Pages.Behaviors.RelationFinderModel'
    ];

    public $relationFinder = [
        'nameFrom' => 'name'
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'entities' => ['KitSoft\TagsManager\Models\Entity']
    ];
    public $belongsTo = [];
    public $morphedByMany = [
        'acts'  => [
            'KitSoft\NPA\Models\Act',
            'name' => 'entity',
            'table' => 'kitsoft_tagsmanager_entities'
        ],
        'posts'  => [
            'RainLab\Blog\Models\Post',
            'name' => 'entity',
            'table' => 'kitsoft_tagsmanager_entities'
        ],
        'pages'  => [
            'KitSoft\Pages\Models\Page',
            'name' => 'entity',
            'table' => 'kitsoft_tagsmanager_entities'
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'icon' => ['System\Models\File', 'order' => 'sort_order'],
    ];
    public $attachMany = [];

    /**
     * getUrlAttribute
     */
    public function getUrlAttribute($host = false)
    {
        $url = $this->asExtension('KitSoft.Pages.Behaviors.RelationFinderModel')
            ->getUrlAttribute($host);
            
        return $url ?? Functions::tagLinkTimeline($this);
    }
}
