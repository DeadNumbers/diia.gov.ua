<?php namespace KitSoft\Search\Classes;

use Config;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use KitSoft\Search\Classes\Composite;
use KitSoft\Search\Classes\Helpers;
use KitSoft\Search\Classes\Interfaces\SearchInterface;
use KitSoft\Search\Providers\Provider;

abstract class AbstractSearch implements SearchInterface
{
    private $providers;
    private $request;
    private $filters;
    private $type;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->filters = Config::get('kitsoft.search::filters');
        $this->providers = Helpers::getProviders();
        $this->type = $request->get('type');
    }

    /**
     * @return JsonResponse
     */
    public function search(): JsonResponse
    {
        $this->request->validate($this->filters);

        $results = (array_key_exists($this->type, $this->providers))
            ? $this->getCompositeCollection([$this->type])->first()
            : $this->getCompositeCollection();

        return Response::json($results);
    }

    /**
     * getCompositeCollection
     */
    protected function getCompositeCollection($filterType = null): Collection
    {
        $collection = new Composite();

        foreach ($this->providers as $key => $provider) {
            $hidden = $provider['hidden'] ?? false;

            // filter by type param
            if ($filterType && !in_array($key, $filterType)) {
                continue;
            }

            // remove hidden provider for all list
            if (!$filterType && $hidden) {
                continue;
            }

            // check for model exist
            if (isset($provider['model']) && !class_exists($provider['model'])) {
                continue;
            }

            if ($object = $this->getProviderObject($provider)) {
                $collection->addElement($object);
            }
        }

        return $collection->composite();
    }
}
