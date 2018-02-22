<?php

namespace FishyMinds;

class Request
{
    private $parameters;

    public function __construct($parameters)
    {
        $this->parameters = $parameters;
    }

    public function get($parameter)
    {
        return array_get($this->parameters, $parameter);
    }

    public function only($parameters)
    {
        return array_only($this->parameters, $parameters);
    }
}