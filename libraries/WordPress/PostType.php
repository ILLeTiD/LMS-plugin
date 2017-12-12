<?php

namespace FishyMinds\WordPress;

use FishyMinds\WordPress\Plugin\HasPlugin;

abstract class PostType
{
    use HasPlugin;

    protected $name = '';

    public function register()
    {
        register_post_type($this->name, $this->arguments());
    }

    abstract protected function arguments();
}