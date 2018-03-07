<?php

namespace LmsPlugin\Controllers;

use FishyMinds\Request;
use FishyMinds\View;
use FishyMinds\WordPress\Plugin\Plugin;

class Controller
{
    /**
     * Instance of the plugin.
     *
     * @var \FishyMinds\WordPress\Plugin\Plugin
     */
    protected $plugin;

    /**
     * Instance of a current request.
     *
     * @var \FishyMinds\Request|null
     */
    protected $request;

    /**
     * Constructor.
     *
     * @param \FishyMinds\WordPress\Plugin\Plugin $plugin
     * @param \FishyMinds\Request|null $request
     */
    public function __construct(Plugin $plugin, Request $request = null)
    {
        $this->plugin = $plugin;
        $this->request = $request;
    }

    protected function view($name, $variables = [])
    {
        (new View($this->plugin))
            ->template($name)
            ->with($variables)
            ->display();
    }
}