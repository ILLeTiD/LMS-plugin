<?php

namespace FishyMinds\WordPress\Plugin;

class Style
{
    private $handler;
    private $source;
    private $dependencies;
    private $version;
    private $media;

    public function __construct($handler, $source, $dependencies = [], $version = false, $media = 'all')
    {
        $this->handler = $handler;
        $this->source = $source;
        $this->dependencies = $dependencies;
        $this->version = $version;
        $this->media = $media;
    }

    public function add()
    {
        wp_enqueue_style($this->handler, $this->source, $this->dependencies, $this->version, $this->media);
    }
}