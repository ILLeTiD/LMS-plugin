<?php

namespace FishyMinds\WordPress\Plugin;

class Filter extends Extension
{
    public function add()
    {
        add_filter($this->name, $this->callable, $this->priority, $this->parameters);
    }
}