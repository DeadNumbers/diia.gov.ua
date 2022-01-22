<?php namespace KitSoft\Pages\Models;

use Db;
use Illuminate\Support\Collection;
use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Models\Page;
use Model;
use System\Classes\PluginManager;

/**
 * Component Model
 */
class Component extends Model
{
    use \October\Rain\Database\Traits\Sortable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_pages_components';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $jsonable = ['fields', 'properties'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * page
     */
    public function entity() {
        return Db::table('kitsoft_pages_entities')
            ->where('entity_type', self::class)
            ->where('entity_id', $this->id)
            ->first();
    }

    /**
     * beforeCreate
     */
    public function beforeCreate() {
        $this->alias = $this->name;
    }

    /**
     * scopeIsPublished
     */
    public function scopeIsPublished($query)
    {
        return $query
            ->where('published', true);
    }

    /**
     * getPagesOptions
     */
    public function getPagesOptions() {
        return Page::trans()
            ->orderBy('nest_left', 'asc')
            ->listsNested('title', 'id');
    }

    /**
     * getAvailableComponents
     */
    public static function getAvailableComponents(string $layout = null): Collection
    {
        $components = self::getAllAvailableComponents();

        if ($config = PagesHelper::getComponentsConfigByLayout($layout)) {
            $components = $components->filter(function ($item) use ($config) {
                return in_array(get_class($item), $config);
            });
        }

        return $components->groupBy(function ($item) {
            return $item->id;
        });
    }

    /**
     * getAllAvailableComponents
     */
    public static function getAllAvailableComponents(): Collection
    {
        $result = collect();
        $pluginManager = PluginManager::instance();
        $plugins = $pluginManager->getPlugins();

        foreach ($plugins as $plugin) {
            $components = $plugin->registerComponents();

            if (!is_array($components)) {
                continue;
            }

            foreach ($components as $class => $name) {
                $component = new $class();

                if ($component->hidden) {
                    continue;
                }

                $component->id = trans(array_get($plugin->pluginDetails(), 'name'));
                $component->alias = $name;
                $component->name = trans(array_get($component->componentDetails(), 'name'));

                $result = $result->push($component);
            }
        }

        return $result;
    }
}
