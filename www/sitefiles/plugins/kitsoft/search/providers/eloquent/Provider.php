<?php namespace KitSoft\Search\Providers\Eloquent;

use Event;
use Cms\Classes\Page;
use Config;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use KitSoft\Search\Classes\Helpers;
use October\Rain\Argon\Argon;
use Validator;
use ValidationException;

class Provider
{
    public $collection;

    protected $search;
    protected $model;
    protected $query;
    protected $perPage;
    protected $scopes;
    protected $publicFields;
    protected $customUrl;
    protected $searchableColumns;
    protected $orderBy;
    protected $files;

    protected $filters = ['key', 'type'];
    protected $rules = [];

    public function __construct(array $options)
    {
        extract($options);

        $this->alias = $alias;
        $this->collection = $collection;
        $this->scopes = $scopes;
        $this->publicFields = $publicFields;
        $this->files = $files ?? [];
        $this->customUrl = $customUrl ?? null;
        $this->orderBy = $orderBy ?? null;
        $this->searchableColumns = $searchableColumns;
        $this->dynamicAttributes = $dynamicAttributes ?? [];
        $this->search = request()->get('key');
        $this->model = $model;
        $this->query = $this->model::query();

        $this->setPerPage();
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

        $this->perPage = $this->perPage ?? Config::get('kitsoft.search::paginate') ?? 5;
    }

    /**
     * search
     */
    public function search(): LengthAwarePaginator
    {
        $this->validateFilters();

        $results = $this->buildQuery();

        $results->transform(function ($item) {
            // set url
            if (!$this->customUrl) {
                $item->attributes['url'] = $item->full_url;
            }

            $this->attachFiles($item);

            // set dynamic attributes
            foreach ($this->dynamicAttributes as $code => $attribute) {
                $item->attributes[$code] = object_get($item, $attribute);
            }

            // extend results by item if exist method for current provider
            if (method_exists($this, 'prepareItem')) {
                $this->prepareItem($item);
            }

            return $item->attributes;
        });

        $results->appends(request()->only($this->filters))
            ->appends(['type' => $this->alias]);

        return $results;
    }

    /**
     * buildQuery
     */
    protected function buildQuery()
    {
        $this->applyScopes();
        $this->applyPublicFields();
        $this->applyFilters();
        $this->applyOrderBy();

        Event::fire('kitsoft.search::providers.eloquent.extendQuery', [&$this->query]);

        // extend query if exist method for current provider
        if (method_exists($this, 'extendQuery')) {
            $this->extendQuery($this->query);
        }

        return $this->query
            ->paginate($this->perPage);
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
     * applyScopes
     */
    protected function applyScopes()
    {
        foreach ($this->scopes as $scope) {
            $this->query->$scope();
        }
    }

    /**
     * applyPublicFields
     */
    protected function applyPublicFields()
    {
        $this->query->select(array_merge($this->searchableColumns, $this->publicFields, ['id']));
    }

    /**
     * applyKeyFilter
     */
    protected function applyKeyFilter()
    {
        $columns = $this->searchableColumns;

        $this->query->where(function ($query) use ($columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'ilike', "%{$this->search}%");
            }
            
            // filter by sections if model has relation
            if ($this->model::make()->hasRelation('sections')) {
                $query->orWhereHas('sections', function ($query) {
                    $search = json_encode($this->search);
                    $search = trim($search, '"');
                    $search = addslashes($search);
                    $query->where('fields', 'ilike', "%{$search}%");
                });
            }
        });
    }

    /**
     * applyOrderBy
     */
    protected function applyOrderBy()
    {
        if (!is_array($this->orderBy) || !count($this->orderBy)) {
            return;
        }

        if (is_array($this->orderBy[0])) {
            foreach ($this->orderBy as $row) {
                $this->query->orderBy($row[0], $row[1]);
            }
        } else {
            $this->query->orderBy($this->orderBy[0], $this->orderBy[1]);
        }
    }

    /**
     * applyFromFilter
     */
    protected function applyFromFilter()
    {
        if ($data = request()->from) {
            $this->query->whereDate('published_at', '>=', Argon::parse($data));
        }
    }

    /**
     * applyToFilter
     */
    protected function applyToFilter()
    {
        if ($data = request()->to) {
            $this->query->whereDate('published_at', '<=', Argon::parse($data));
        }
    }

    /**
     * attachFiles
     */
    protected function attachFiles(&$item)
    {
        $files = Helpers::attachModelFiles($item, $this->files);

        $item->attributes = array_merge($item->attributes, $files);
    }
}
