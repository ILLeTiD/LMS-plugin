<?php

namespace FishyMinds\WordPress\Plugin;

use FishyMinds\WordPress\Plugin\Router\Router;
use FishyMinds\WordPress\Plugin\Updater\Repository;
use FishyMinds\WordPress\Plugin\Updater\Updater;

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
        $router = new Router($this->plugin);
        $this->plugin->setRouter($router);
        $this->actionLoader->add('template_redirect', [$router, 'routeRequest']);
        $this->filterLoader->add('query_vars', [$router, 'whitelistRouteParameter']);

        $this->loadActions();
        $this->loadFilters();
    }

    private function loadActions()
    {
        $styleLoader = new StyleLoader($this->plugin);
        $this->actionLoader->add('admin_enqueue_scripts', [$styleLoader, 'load']);

        $scriptLoader = new ScriptLoader($this->plugin);
        $this->actionLoader->add('admin_enqueue_scripts', [$scriptLoader, 'load']);

        $this->actionLoader->load();
    }

    private function loadFilters()
    {
        $updater = new Updater($this->plugin, new Repository);
        $this->filterLoader->add('pre_set_site_transient_update_plugins', [$updater, 'setTransient']);
        $this->filterLoader->add('plugins_api', [$updater, 'setPluginInfo']);
        $this->filterLoader->add('upgrader_post_install', [$updater, 'after']);

        $this->filterLoader->load();
    }
}
