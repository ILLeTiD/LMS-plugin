<?php

namespace FishyMinds;

use FishyMinds\WordPress\Plugin\HasPlugin;
use FishyMinds\WordPress\Plugin\Plugin;
use InvalidArgumentException;

class View
{
    use HasPlugin;

    private $name;
    private $file;
    private $variables = [];

    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
        $this->variables[] = $plugin;
    }

    public function template($name)
    {
        $this->name = $name;
        $this->file = $this->plugin->getDirectory('views/' . str_replace('.', '/', $name) . '.php');

        return $this;
    }

    public function with(array $variables)
    {
        $this->variables = $variables;
        $this->variables['plugin'] = $this->plugin;

        return $this;
    }

    public function display()
    {
        if ( ! file_exists($this->file)) {
            throw new InvalidArgumentException('View not found: ' . $this->name);
        }

        extract($this->variables);

        require_once $this->file;
    }
}