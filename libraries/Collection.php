<?php

namespace FishyMinds;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class Collection implements IteratorAggregate, Countable
{
    private $items = [];

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return ArrayIterator
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    public function map($callback)
    {
        return array_map($this->items, $callback);
    }

    public function filter($callback, $flag = 0)
    {
        return array_filter($this->items, $callback, $flag);
    }

    public function first()
    {
        return $this->items[0];
    }

    /**
     * Return part of the collection.
     *
     * @param int $number
     *
     * @return \FishyMinds\Collection
     */
    public function take($number)
    {
        $part = array_slice($this->items, 0, $number);
        return new self($part);
    }

    public function pluck($column)
    {
        return array_map(function ($item) use ($column) {
            return is_object($item) ? $item->$column : $item[$column];
        }, $this->items);
    }

    public function join($glue)
    {
        return implode($glue, $this->items);
    }
}