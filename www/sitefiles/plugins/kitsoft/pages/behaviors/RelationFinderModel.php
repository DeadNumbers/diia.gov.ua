<?php namespace KitSoft\Pages\Behaviors;

use Cache;
use Event;
use Exception;
use Illuminate\Support\Facades\Crypt;
use KitSoft\Pages\Models\Page;
use KitSoft\Pages\Models\Settings;
use October\Rain\Extension\ExtensionBase;
use System\Classes\PluginManager;

/**
 * RelationFinderModel Behavour
 */
class RelationFinderModel extends ExtensionBase
{
    protected $model;

    /**
     * Constructor
     */
    public function __construct($model)
    {
    	$this->model = $model;

    	$this->model->addDynamicMethod('getRelationFinderConfig', function () {
    		return $this->model->relationFinder
    			? $this->model->relationFinder
    			: ['nameFrom' => 'title'];
		});

		$this->model->bindEvent('model.afterUpdate', function () {
            Cache::forget($this->getUrlAttributeCacheKey(true));
            Cache::forget($this->getUrlAttributeCacheKey(false));
        });
    }

    /**
	 * getRelationTitleAttribute
	 */
	public function getRelationTitleAttribute()
	{
		$config = $this->model->getRelationFinderConfig();

        $nameFrom = $config['nameFrom'] ?? 'title';
        $descriptionFrom = $config['descriptionFrom'] ?? null;

        return $descriptionFrom
            ? $this->model->{$nameFrom} . ' ' . $this->model->{$descriptionFrom}
            : $this->model->{$nameFrom};
	}

	/**
	 * getHashAttribute
	 */
	public function getHashAttribute()
	{
		return Crypt::encrypt([
			'model' => get_class($this->model),
			'id' => $this->model->id,
			'attributes' => [
				'lang' => $this->model->lang ? $this->model->lang->locale : null
			]
		]);
	}

    /**
	 * getUrlAttribute
	 */
	public function getUrlAttribute($host = false)
	{
        // load from cache if exist
        if ($url = Cache::get($this->getUrlAttributeCacheKey((bool)$host))) {
            return $url;
        }        

		try {
			Event::fire('kitsoft.pages::relationFinder.beforeGetUrl', [$this->model]);

			$url = $this->getRelationFinderUrl();

			Event::fire('kitsoft.pages::relationFinder.beforeSetHost', [$this->model, &$url]);

			$url = $host ? url($url) : $url;

			Event::fire('kitsoft.pages::relationFinder.afterGetUrl', [$this->model, &$url]);
		} catch (Exception $e) {
			trace_log($e);
			return;
		}

		// save to cache for 30 minutes
		Cache::put($this->getUrlAttributeCacheKey((bool)$host), $url, 30);

		return $url;
	}

	/**
	 * getFullUrlAttribute
	 */
	public function getFullUrlAttribute()
	{
		return $this->model->getUrlAttribute(true);
	}

	/**
	 * getRelationFinderUrl
	 */
	protected function getRelationFinderUrl()
	{
		switch ($this->getUrlType()) {
			case 'sluggable':
				$url = $this->getSluggableUrl();
				break;
			case 'nested_tree':
				$url = $this->getNestedTreeUrl($this->model->toArray());
				break;
			default:
				$url = array_get($this->model->attributes, 'url');
				break;
		}

		return $url;
	}

	/**
	 * getUrlType
	 * Types: sluggable, nested_tree
	 */
	protected function getUrlType()
	{
		$config = $this->model->getRelationFinderConfig();
        
        if ($sluggable = $config['sluggable'] ?? true) {
        	return 'sluggable';
        }

        if (in_array('October\Rain\Database\Traits\NestedTree', class_uses($this->model))) {
        	return 'nested_tree';
        }
	}

	/**
	 * getSluggableUrl
	 */
	protected function getSluggableUrl(): string
	{
		$modelClass = get_class($this->model);

		if (!$router = Settings::get("routes.{$modelClass}")) {
			return '';
		}

		$url = Page::findOrFail($router)
			->asExtension('KitSoft.Pages.Behaviors.RelationFinderModel')
			->getRelationFinderUrl();

		$url = str_replace(':id', $this->model->id, $url);
        $url = str_replace(':slug', $this->model->slug, $url);

        return $url;
	}

	/**
	 * getNestedTreeUrl
	 */
	protected function getNestedTreeUrl(array $attributes, $slug = null): string
	{
		$slug = $attributes['slug'] . $slug;
        $slug = (($attributes['slug'] == '/') ? '' : '/') . $slug;

        if (!$attributes['parent_id']) {
            return $slug;
        }

        $parent = $this->model::withoutGlobalScopes()
            ->select('slug', 'parent_id', 'id')
            ->find($attributes['parent_id']);

        return ($parent)
            ? $this->getNestedTreeUrl($parent->toArray(), $slug)
            : $slug;

	}

	/**
	 * getUrlAttributeCacheKey
	 */
	protected function getUrlAttributeCacheKey(bool $host): string
	{
		return "kitsoft.pages::relationFinderUrl.{$this->model->getTable()}.{$this->model->id}.{$host}";
	}
}