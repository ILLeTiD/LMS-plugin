<?php

namespace FishyMinds\WordPress\Plugin;

trait HasPlugin
{
    /**
     * Instance of the plugin.
     *
     * @var \FishyMinds\WordPress\Plugin\Plugin
     */
    protected $plugin;

    /**
     * HasPlugin constructor.
     *
     * @param \FishyMinds\WordPress\Plugin\Plugin $plugin
     */
    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
    }
}
