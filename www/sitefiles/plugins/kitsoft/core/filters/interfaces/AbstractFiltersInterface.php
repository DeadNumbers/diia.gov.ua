<?php namespace KitSoft\Core\Filters\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface AbstractFiltersInterface
{
	public function __construct();
	public function apply(Builder $builder): Builder;
}