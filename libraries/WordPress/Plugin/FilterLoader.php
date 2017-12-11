<?php

namespace FishyMinds\WordPress\Plugin;

class FilterLoader extends ExtensionLoader
{
    /**
     * @inheritdoc
     *
     * @return \FishyMinds\WordPress\Plugin\Filter
     */
    public function add($name, $callable, $priority = 10)
    {
        $callable = $this->resolve($callable);

        $parameters = $this->determineParametersNumber($callable);

        return $this->extensions[] = new Filter($name, $callable, $priority, $parameters);
    }

    protected function readFile()
    {
        $file = $this->plugin->getDirectory('/extensions/filters.php');

        if (file_exists($file)) {
            extract([
                'filter' => $this,
                'plugin' => $this->plugin
            ]);

            require_once $file;
        }
    }
}
