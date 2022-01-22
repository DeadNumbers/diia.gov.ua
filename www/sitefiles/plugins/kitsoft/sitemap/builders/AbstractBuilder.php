<?php namespace KitSoft\Sitemap\Builders;

use Config;
use Model;
use KitSoft\Pages\Models\Settings as PagesSettings;
use KitSoft\Sitemap\Models\Settings as SitemapSettings;

/**
 * AbstractBuilder
 */
abstract class AbstractBuilder
{
	protected $page;
	protected $iteration;
	protected $sitemap;
	protected $limit;
	protected $chunk;

	protected $folder = 'storage/app/sitemap';
	protected $prefix = 'sitemap';

	protected $robotsTxtMask = "Sitemap: %s/sitemap.xml\r\n";

	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->limit = Config::get('kitsoft.sitemap::config.limit');
		$this->chunk = Config::get('kitsoft.sitemap::config.chunk');
	}

	/**
	 * getModels
	 */
	protected function getModels()
	{
		return PagesSettings::instance()
            ->getConfiguredRelationFinderModels();
	}

	/**
	 * getModelCode
	 */
	protected function getModelCode(Model $model)
	{
		return str_slug(get_class($model));
	}

	/**
	 * getSitemapModelUrl
	 */
	protected function getSitemapModelUrl(Model $model, int $page = 1)
	{
		$code = $this->getModelCode($model);

		return prepared_secure_url("{$this->prefix}-{$code}-{$page}.xml");
	}

	/**
	 * getSitemapModelPath
	 */
	public function getSitemapModelPath(Model $model, int $page)
	{
		$code = $this->getModelCode($model);

		return $this->getSitemapPath() . "-{$code}-{$page}";
	}

	/**
	 * getFile
	 */
	public function getFile($postfix = null)
	{
		$path = $this->getSitemapPath();
		$path .= $postfix;
		$path = base_path($path);

		return @file_get_contents($path);
	}

	/**
     * buildTypesSitemap
     */
    protected function buildTypesSitemap(Model $model)
    {
        $this->page = 1;
        $this->iteration = 0;

        echo 'Build ' . $this->getSitemapModelPath($model, $this->page) . "\n";

        $this->makeQuery($model)->chunk($this->chunk, function ($items) {
            $items->each(function ($item) {
                $this->iteration++;

                // if more than limit, create next file and add it to main sitemap
                if (!($this->iteration % $this->limit)) {
                    $this->sitemap->store('xml',
                    	$this->getSitemapModelPath($item, $this->page)
                	);
                    $this->sitemap->addSitemap($this->getSitemapModelUrl($item, $this->page));
                    $this->sitemap->model->resetItems();
                    $this->page++;

                    echo 'Build ' . $this->getSitemapModelPath($item, $this->page) . "\n";
                }

                $this->sitemap->add(
                    prepared_secure_url($item->url),
                    $item->published_at ?? $item->created_at,
                    SitemapSettings::instance()->getPriority(get_class($item)),
                    SitemapSettings::instance()->getChangefreq(get_class($item))
                );
            });
        });

        // save file and add it to main sitemap
        $this->sitemap->store('xml',
        	$this->getSitemapModelPath($model, $this->page)
    	);
        $this->sitemap->addSitemap($this->getSitemapModelUrl($model, $this->page));
        $this->sitemap->model->resetItems();

        return $this->sitemap->store('sitemapindex', $this->getSitemapIndexPath());
    }

    /**
     * makeQuery
     */
    protected function makeQuery(Model $model)
    {
    	$config = Config::get('kitsoft.sitemap::config.models');
        $config = collect($config)->where('model', get_class($model))->first();

        $query = $model::make();

        // scopes
        if (isset($config['scopes'])) {
        	foreach ($config['scopes'] as $scope) {
        		if (method_exists($model, 'scope' . ucfirst($scope))) {
        			$query = $query->{$scope}();
        		}
        	}
        }
        
        // orderBy
        if (isset($config['orderBy'])) {
        	$query = $query->orderBy($config['orderBy'][0], $config['orderBy'][1]);
        }

        return $query;
    }
}