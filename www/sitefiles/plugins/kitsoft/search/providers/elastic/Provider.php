<?php namespace KitSoft\Search\Providers\Elastic;

use App;
use Event;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use KitSoft\Search\Classes\ElasticResponseHandler;
use KitSoft\Search\Classes\Helpers;
use KitSoft\Search\Models\Settings;
use October\Rain\Argon\Argon;
use Validator;
use ValidationException;

class Provider
{
    public $collection;

    protected $alias;
    protected $client;
    protected $model;
    protected $perPage;
    protected $currentPage;
    protected $offset;
    protected $publicFields;
    protected $searchableColumns;
    protected $requestTemplate;
    protected $files;

    protected $filters = ['key', 'from', 'to'];
    protected $rules = [];

    protected $timeout = 5;

    public function __construct(array $options)
    {
        extract($options);

        $this->alias = $alias;
        $this->model = $model;
        $this->collection = $collection;
        $this->publicFields = $publicFields;
        $this->files = $files ?? [];
        $this->searchableColumns = $searchableColumns;
        $this->currentPage = request()->get('page') ?? 1;

        $this->setPerPage();

        $this->offset = $this->currentPage * $this->perPage - $this->perPage;
        $this->client = App::make('KitSoft\Search\Classes\Interfaces\ElasticClientContract');
    }

    /**
     * setPerPage
     */
    public function setPerPage(int $perPage = null)
    {
        if ($perPage) {
            $this->perPage = $perPage;
            return;
        }

        $perPage = (int)request()->get('per_page');

        if ($perPage && $perPage <= 100) {
            $this->perPage = $perPage;
            return;
        }

        $this->perPage = $this->perPage ?? Settings::get('elastic_per_page') ?? 5;
    }

    /**
     * search
     */
    public function search()
    {
        $items = [];

        $this->validateFilters();

        try {
            $this->setRequestTemplate();
            $this->applyFilters();

            $response = $this->client->searchTemplate($this->requestTemplate);
            $responseHandler = new ElasticResponseHandler($response);

            $total = $responseHandler->getTotal();
            $items = $responseHandler->getItems();
            $suggest = $responseHandler->getSuggest();

            foreach ($items as &$row) {
                $row = $this->basePrepareItem($row);
            }

            $paginator = $this->paginator($items, $total);

            $result = array_merge($paginator->toArray(), [
                'suggest' => $suggest
            ]);

            if (method_exists($this, 'prepareResponse')) {
                $result = $this->prepareResponse($result, $responseHandler, $paginator);
            }
        } catch (Exception $e) {
            trace_log($e);
            return;
        }

        return $result;
    }

    /**
     * basePrepareItem
     */
    protected function basePrepareItem($item)
    {
        if ($this->publicFields == '*') {
            $result = $item;
        } else {
            $allowedFields = array_merge(
                $this->searchableColumns,
                $this->publicFields,
                $this->files,
                ['title', 'url', '@timestamp', 'highlights']
            );

            $result = array_intersect_key($item, array_flip($allowedFields));
        }

        // extend results by item if exist method for current provider
        if (method_exists($this, 'prepareItem')) {
            $this->prepareItem($result, $item);
        }

        return $result;
    }

    /**
     * setRequestTemplate
     */
    protected function setRequestTemplate()
    {
        $params = [
            'selected_from' => $this->offset,
            'selected_size' => $this->perPage,
            'suggestion' => '{{suggestion}}'
        ];

        if (method_exists($this, 'extendDefaultFilter')) {
            $params = $this->extendDefaultFilter($params);
        }

        $this->requestTemplate = [
            'index' => Helpers::getElasticIndex($this->alias),
            'body' => [
                'id' => Helpers::getElasticTemplate($this->alias),
                'params' => $params
            ],
            'client' => [
                'timeout' => $this->timeout,
                'connect_timeout' => $this->timeout
            ]
        ];

        $this->applyFilters();

        Event::fire('kitsoft.search::providers.elastic.requestTemplate', [$this->alias, &$this->requestTemplate]);
    }

    /**
     * validateFilters
     */
    protected function validateFilters()
    {
        foreach ($this->rules as $param => $rules) {
            $validator = Validator::make(request()->only([$param]), [
                $param => $rules
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        }
    }

    /**
     * applyFilters
     */
    protected function applyFilters()
    {
        foreach ($this->filters as $filter) {
            $method = 'apply' . studly_case($filter) . 'Filter';
            if (!method_exists($this, $method)) {
                continue;
            }
            $this->$method();
        }
    }

    /**
     * applyKeyFilter
     */
    protected function applyKeyFilter()
    {
        $this->requestTemplate['body']['params']['selected_search_text'] = request()->get('key');
    }

    /**
     * applyFromFilter
     */
    protected function applyFromFilter()
    {
        if (!$from = request()->get('from')) {
            return;
        }

        $this->requestTemplate['body']['params']['selected_event_range_start'] = $from
            ? Argon::parse($from)->toAtomString()
            : Argon::now()->toAtomString();
    }

    /**
     * applyToFilter
     */
    protected function applyToFilter()
    {
        $to = request()->get('to');

        $this->requestTemplate['body']['params']['selected_event_range_end'] = $to
            ? Argon::parse($to)->setTime(23, 59, 59)->toAtomString()
            : Argon::now()->toAtomString();
    }

    /**
     * applyTagsFilter
     */
    public function applyTagsFilter()
    {
        $this->requestTemplate['body']['params']['selected_tag_slugs'] = request()->get('tags');
    }

    /**
     * paginator
     */
    protected function paginator(array $data, int $total): LengthAwarePaginator
    {
        $paginate = new LengthAwarePaginator($data, $total, $this->perPage, $this->currentPage);

        return $paginate
            ->appends(request()->only($this->filters))
            ->appends(['type' => $this->alias]);
    }
}
