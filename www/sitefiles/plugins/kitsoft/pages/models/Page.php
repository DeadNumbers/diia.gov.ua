<?php namespace KitSoft\Pages\Models;

use Model;
use Config;
use Artisan;
use BackendAuth;
use ValidationException;
use Cms\Classes\Page as CmsPage;
use October\Rain\Argon\Argon;
use KitSoft\Core\Classes\BackendPreview;
use ApplicationException;

/**
 * Page Model
 */
class Page extends Model
{
    use \October\Rain\Database\Traits\NestedTree;
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    public $table = 'kitsoft_pages_pages';

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
        'KitSoft.Pages.Behaviors.RelationFinderModel',
        '@KitSoft.Pages.Behaviors.ContentHandlerModel'
    ];

    public $rules = [
        'title' => 'required|max:191',
        'slug'  => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'nestedUnique', 'max:191']
    ];

    protected $dates = ['published_at', 'created_at', 'updated_at', 'deleted_at', 'archived_at'];

    protected $guarded  = ['*'];
    protected $fillable = [];
    protected $jsonable = ['fields'];

    protected $templatesPath = 'pages';

    public $relationFinder = [
        'sluggable' => false
    ];

    public $contentHandlerFields = ['content'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'denied_users' => [
            'Backend\Models\User',
            'table'      => 'kitsoft_pages_pages_denied',
            'order'      => 'login',
            'conditions' => 'is_superuser = false'
        ],
        'granted_users' => [
            'Backend\Models\User',
            'table'      => 'kitsoft_pages_pages_granted',
            'order'      => 'login',
            'conditions' => 'is_superuser = false'
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public $morphedByMany = [
        'components' => [
            'KitSoft\Pages\Models\Component',
            'name'   => 'entity',
            'key'    => 'page_id',
            'table'  => 'kitsoft_pages_entities',
            'order'  => 'sort_order asc',
            'delete' => true
        ],
        'sections' => [
            'KitSoft\Pages\Models\Section',
            'name'   => 'entity',
            'key'    => 'page_id',
            'table'  => 'kitsoft_pages_entities',
            'order'  => 'sort_order asc',
            'delete' => true
        ]
    ];

    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->forceDeleting = !config('kitsoft.pages::enableTrash');
    }

    /**
     * beforeCreate
     */
    public function beforeCreate()
    {
        $this->published_at = $this->published_at ?? Argon::now();
    }

    /**
     * beforeValidate
     */
    public function beforeValidate()
    {
        // fix nested for parent_id dropdown field
        $this->parent_id = empty($this->parent_id) ? null : $this->parent_id;

        // exclude home from parent
        $parent = self::find($this->parent_id);
        if ($parent && $parent->slug == '/') {
            throw new ValidationException(['parent_id' => 'Головна не може бути батьківською сторінкою']);
        }

        if ($this->sluggable) {
            $this->rules['slug'][] = 'regex:/^([:]{1}[a-zA-Z_-]+[\/]?)+[a-zA-Z_-]{1}$/';
        }
    }

    /**
     * deleteDescendants
     */
    public function deleteDescendants()
    {
        if ($this->getAllChildren()->count()) {
            throw new ApplicationException('Спочатку треба видалити дочірні сторінки.');
        }
    }

    /**
     * afterDelete
     */
    public function afterDelete()
    {
        self::withoutGlobalScopes()
            ->onlyTrashed()
            ->where(function ($query) {
                $query->where('nest_left', '<>', 0)->orWhere('nest_right', '<>', 0);
            })
            ->get()
            ->each(function ($item) {
                $item->nest_left = $item->nest_right = 0;
                $item->forceSave();
            });
    }

    /**
     * afterUpdate
     */
    public function afterUpdate()
    {
        if ($this->parent_id && $this->isDirty('parent_id')) {
            $this->makeChildOf($this->parent_id);
        }
    }

    /**
     * beforeSave
     */
    public function beforeSave()
    {
        unset($this->layout_content);
    }

    /**
     * getLayoutOptions
     */
    public function getLayoutOptions()
    {
        return CmsPage::all()
            ->filter(function ($item) {
                return $item->hasComponent('page');
            })
            ->mapWithKeys(function ($item, $key) {
                $filename = basename($key, '.htm');
                return [$filename => $filename];
            })
            ->sort();
    }

    /**
     * getRouterOptions
     */
    public function getRouterOptions()
    {
        return self::orderBy('nest_left')
            ->where('sluggable', true)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->getLocationPath($item->id, $item->title)];
            });
    }

    /**
     * scopeIsPublished
     */
    public function scopeIsPublished($query)
    {
        return $query
            ->whereNotNull('published')
            ->where('published', true)
            ->where(function ($query) {
                return $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', Argon::now());
            });
    }

    /**
     * scopeIsPublishedOrPreview
     */
    public function scopeIsPublishedOrPreview($query)
    {
        if (BackendPreview::isValidPreview()) {
            return $query;
        }

        return $query->isPublished();
    }

    /**
     * scopeIsSearchable
     */
    public function scopeIsSearchable($query)
    {
        return $query
            ->where('searchable', true);
    }

    /**
     * scopeIsNotSluggable
     */
    public function scopeIsNotSluggable($query)
    {
        return $query->where('sluggable', false);
    }

    /**
     * scopeHasAccess
     */
    public function scopeHasAccess($query, $user)
    {
        if ($user->isSuperUser()) {
            return $query;
        }

        if (Config::get('kitsoft.pages::config.accessByDenied')) {
            return $query->whereDoesntHave('denied_users', function ($query) use ($user) {
                $query->where('id', $user->id);
            });
        } else {
            return $query->whereHas('granted_users', function ($query) use ($user) {
                $query->where('id', $user->id);
            });
        }
    }

    /**
     * scopeIsSystem
     */
    public function scopeIsSystem($query, $action = true)
    {
        return $query->where('is_system', $action);
    }

    /**
     * scopeIsNotSystem
     */
    public function scopeIsNotSystem($query)
    {
        return $query->where('is_system', false);
    }

    /**
     * getPagesOptions
     */
    public function getPagesOptions()
    {
        return self::orderBy('nest_left')
            ->get()
            ->listsNested('title', 'id');
    }

    /**
     * getLayoutContentAttribute
     */
    public function getLayoutContentAttribute()
    {
        $page = $this->layout
            ? CmsPage::find($this->layout)
            : null;

        return $page ?
            $page->getTwigContent()
            : null;
    }

    /*
     * getSluggableKeysAttribute
     */
    public function getSluggableKeysAttribute(): array
    {
        if (!$this->sluggable) {
            return [];
        }

        $params = explode('/', $this->attributes['slug']);

        return collect($params)
            ->transform(function ($item) {
                return substr($item, 1);
            })
            ->toArray();
    }

    /**
     * setUrlAttribute
     */
    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = $value;
    }

    /*
     * getUrlAttribute
     */
    public function getUrlAttribute($host = false)
    {
        if (isset($this->fields['link']['url']) && !empty($this->fields['link']['url'])) {
            return $this->fields['link']['url'];
        }

        return $this->asExtension('KitSoft.Pages.Behaviors.RelationFinderModel')
            ->getUrlAttribute($host);
    }

    /*
     * getTargetAttribute
     */
    public function getTargetAttribute()
    {
        return isset($this->fields['link']['url'], $this->fields['link']['target'])
            ? $this->fields['link']['target']
            : null;
    }

    /**
     * getLocationPathAttribute
     */
    public function getLocationPathAttribute()
    {
        return $this->getLocationPath($this->id);
    }

    /**
     * getChildsAttribute
     */
    public function getChildsAttribute()
    {
        return $this->children()
            ->isPublished()
            ->get();
    }

    /**
     * getSectionsContentAttribute
     */
    public function getSectionsContentAttribute()
    {
        return $this->content . ' ' . $this->sections
            ->transform(function ($item) {
                return collect($item->fields)->flatten();
            })
            ->collapse()
            ->implode('. ');
    }

    /*
     * getLocationPath
     */
    public function getLocationPath(int $id, $string = null): string
    {
        $page = self::withoutGlobalScopes()->find($id);

        if (!$page->parent_id) {
            return (string)$string;
        }

        if ($parent = self::withoutGlobalScopes()->find($page->parent_id)) {
            $string = "{$parent->title}" . ($string ? " / {$string}" : '');
        } else {
            return '<i>Батьківської сторінки не існує</i>';
        }

        return $this->getLocationPath($parent->id, $string);
    }

    /**
     * getSectionsAttribute
     */
    public function getSectionsAttribute()
    {
        return $this->sections()
            ->get()
            ->where('published', true)
            ->keyBy('name');
    }

    /**
     * getRawSectionsAttribute
     */
    public function getRawSectionsAttribute()
    {
        return $this->sections()
            ->where('published', true)
            ->get();
    }

    /**
     * getComponentsAttribute
     */
    public function getComponentsAttribute()
    {
        return $this->components()
            ->get()
            ->keyBy('alias');
    }

    /**
     * getParentIdOptions
     */
    public function getParentIdOptions()
    {
        $query = self::where('id', '<>', $this->id)
            ->where('slug', '<>', '/');

        $query = ($this->is_system)
            ? $query->isSystem()
            : $query->isSystem(false);

        $items = $query->get()->listsNested('title', 'id');

        return collect($items)
            ->prepend('-', '');
    }

    /**
     * getParentsCollection
     */
    public function getParentsCollection($items = null, $parent_id = null)
    {
        $parent_id = $items ? $parent_id : $this->parent_id;
        $items = $items ?? collect();

        if (!$parent_id) {
            return $items;
        }

        if ($parent = self::isPublished()->find($parent_id)) {
            $items->prepend($parent);
            return $this->getParentsCollection($items, $parent->parent_id);
        }

        return $items;
    }

    public function filterFields($fields, $context = null)
    {
        $user = BackendAuth::getUser();

        if (!$user->hasAnyAccess(['kitsoft.pages.pages.is_system.fields']) && $this->is_system ) {
            $fields->sluggable->readOnly = true;
            $fields->layout->readOnly = true;
            $fields->parent_id->readOnly = true;
            $fields->published->readOnly = true;
            $fields->published_at->type = 'text';
            $fields->published_at->readOnly = true;
            $fields->slug->readOnly = true;
        }
    }
}
