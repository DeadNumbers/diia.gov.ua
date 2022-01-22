<?php

namespace KitSoft\Core\Filters;

use Illuminate\Database\Eloquent\Builder;
use KitSoft\Core\Filters\Interfaces\AbstractFiltersInterface;

abstract class AbstractFilters implements AbstractFiltersInterface
{
    protected $request;
    protected $builder;

    public function __construct()
    {
        $this->request = request();
    }

    /**
     * apply
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if ($value && method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    /**
     * getFilters
     */
    protected function getFilters(): array
    {
        return $this->request->only($this->filters);
    }
}
