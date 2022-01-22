<?php

namespace KitSoft\Search\Classes;

use Illuminate\Support\Collection;

class Composite
{
    private $elements = [];

    /**
     * @return Collection
     */
    public function composite(): Collection
    {
        $result = [];

        foreach ($this->elements as $element) {
            if (!$searchResults = $element->search()) {
                continue;
            }
            $result[$element->collection] = $searchResults;
        }

        return collect($result);
    }

    /**
     * addElement
     */
    public function addElement($element)
    {
        $this->elements[] = $element;
    }
}
