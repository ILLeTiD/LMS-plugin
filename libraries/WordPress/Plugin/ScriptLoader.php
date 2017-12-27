<?php

namespace FishyMinds\WordPress\Plugin;

class ScriptLoader
{
    use HasPlugin;

    private $scripts = [];

    public function load()
    {
        $this->readPluginFile();

        foreach ($this->scripts as $script) {
            $script->enqueue();
        }
    }

    public function getCurrentScreen()
    {
        return get_current_screen();
    }

    private function readPluginFile()
    {
        $file = $this->plugin->getDirectory('assets/scripts.php');

        if (! file_exists($file)) {
            return false;
        }

        extract([
            'script' => $this,
            'plugin' => $this->plugin
        ]);

        require_once $file;
    }

    private function add($handler)
    {
        return $this->scripts[] = new Script($this->plugin, $handler);
    }
}