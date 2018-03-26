<?php

namespace FishyMinds;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class PagedCollection extends Collection
{
    protected $pagination;

    public function __construct(array $items, $pagination)
    {
        $this->items = $items;
        $this->pagination = $pagination;
    }

    public function pagination()
    {
        return $this->pagination;
    }
}