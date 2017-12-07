<?php

namespace FishyMinds\WordPress\Plugin;

abstract class Extension
{
    protected $name;
    protected $callable;
    protected $priority;
    protected $parameters;

    public function __construct($name, $callable, $priority = 10, $parameters = 1)
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->priority = $priority;
        $this->parameters = $parameters;
    }
}