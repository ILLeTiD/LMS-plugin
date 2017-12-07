<?php

namespace FishyMinds\WordPress\Plugin;

class Action extends Extension
{
    public function add()
    {
        add_action($this->name, $this->callable, $this->priority, $this->parameters);
    }
}