<?php

namespace FishyMinds\WordPress\Plugin;

class Loader
{
    use HasPlugin;

    /**
     * @var \FishyMinds\WordPress\Plugin\ExtensionLoader
     */
    private $actionLoader;

    /**
     * @var \FishyMinds\WordPress\Plugin\ExtensionLoader
     */
    private $filterLoader;

    /**
     * Loader constructor.
     *
     * @param \FishyMinds\WordPress\Plugin\Plugin $plugin
     * @param \FishyMinds\WordPress\Plugin\ExtensionLoader $actionLoader
     * @param \FishyMinds\WordPress\Plugin\ExtensionLoader $filterLoader
     */
    public function __construct(Plugin $plugin, ExtensionLoader $actionLoader, ExtensionLoader $filterLoader)
    {
        $this->plugin = $plugin;
        $this->actionLoader = $actionLoader;
        $this->filterLoader = $filterLoader;
    }

    /**
     *
     */
    public function load()
    {
        $this->actionLoader->load();
        $this->filterLoader->load();
    }
}
