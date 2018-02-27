<?php

namespace FishyMinds;

class Request
{
    private $parameters;

    public function __construct($parameters)
    {
        $this->parameters = $parameters;
    }

    public function get($parameter, $default = null)
    {
        return array_get($this->parameters, $parameter, $default);
    }

    public function only($parameters)
    {
        return array_only($this->parameters, $parameters);
    }
}