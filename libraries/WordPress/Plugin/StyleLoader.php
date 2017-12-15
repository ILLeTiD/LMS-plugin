<?php

namespace FishyMinds\WordPress\Plugin;

class StyleLoader
{
    use HasPlugin;

    private $styles = [];

    public function load()
    {
        $file = $this->plugin->getDirectory('/assets/styles.php');

        if (! file_exists($file)) {
            return false;
        }

        extract([
            'style' => $this,
            'plugin' => $this->plugin
        ]);

        require_once $file;

        foreach ($this->styles as $style) {
            $style->add();
        }
    }

    private function add($handler, $source, $dependencies = [], $version = false, $media = 'all')
    {
        $source = $this->plugin->getUrl() . '/assets/css/' . $source;
        $version = $version ? $version : $this->plugin->getVersion();

        $this->styles[] = new Style($handler, $source, $dependencies, $version, $media);
    }
}