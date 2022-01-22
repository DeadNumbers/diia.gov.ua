<?php

namespace KitSoft\Core\Classes;

abstract class AbstractFilters
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
    public function apply($builder)
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
    protected function getFilters()
    {
        return $this->request->only($this->filters);
    }
}
