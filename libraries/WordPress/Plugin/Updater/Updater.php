<?php

namespace FishyMinds\WordPress\Plugin\Updater;

use FishyMinds\WordPress\Plugin\Plugin;
use stdClass;

class Updater
{
    private $plugin;
    private $repository;

    public function __construct(Plugin $plugin, Repository $repository)
    {
        $this->plugin = $plugin;
        $this->repository = $repository;
    }

    public function setTransient($transient)
    {
        if (empty($transient->checked)) {
            return $transient;
        }

        $lastRelease = $this->repository->getLastRelease();

        $doUpdate = version_compare($lastRelease->name, $transient->checked[$this->plugin->getSlug()], '>');

        if (! $doUpdate) {
            return $transient;
        }

        $package = $this->repository->getDownloadUrl();

        $obj = new stdClass;
        $obj->slug = $this->plugin->getSlug();
        $obj->new_version = $lastRelease->name;
        $obj->url = $this->plugin->getData('PluginURI');
        $obj->package = $package;

        $transient->response[$obj->slug] = $obj;

        return $transient;
    }

    public function setPluginInfo($false, $action, $response)
    {
        if ( empty($response->slug) || $response->slug != $this->plugin->getSlug()) {
            return $false;
        }

        // $response->last_updated = $this->githubAPIResult->published_at;
        $response->slug = $this->plugin->getSlug;
        $response->plugin_name  = $this->plugin->getData('Name');
        $response->version = $this->lastRelease->tag_name;
        $response->author = $this->plugin->getData('Author');
        $response->homepage = $this->plugin->getData('PluginURI');
        $response->sections = [
            'Description'   => $this->plugin->getData('Description'),
            // 'changelog'     => Parsedown::instance()->parse($this->lastRelease->description)
        ];
        return $response;
    }

    public function after($response, $hook, $result)
    {
        global $wp_filesystem;

        $dir = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . dirname($this->plugin->getSlug());
        $wp_filesystem->move($result['destination'], $dir, true);

        $result['destination'] = $dir;

        return $result;
    }
}