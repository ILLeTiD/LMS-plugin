<?php

namespace FishyMinds\WordPress\Plugin;

class ActionLoader extends ExtensionLoader
{
    /**
     * @inheritdoc
     *
     * @return \FishyMinds\WordPress\Plugin\Action
     */
    public function add($name, $callable, $priority = 10)
    {
        $callable = $this->resolve($callable);

        $parameters = $this->determineParametersNumber($callable);

        return $this->extensions[] = new Action($name, $callable, $priority, $parameters);
    }

    protected function readFile()
    {
        $file = $this->plugin->getDirectory('/extensions/actions.php');

        if (file_exists($file)) {
            extract([
                'action' => $this,
                'plugin' => $this->plugin
            ]);

            require_once $file;
        }
    }
}