<?php

namespace FishyMinds\WordPress\Plugin;

use InvalidArgumentException;
use ReflectionFunction;
use ReflectionMethod;

abstract class ExtensionLoader
{
    use HasPlugin;

    /**
     * @var array
     */
    protected $extensions = [];

    /**
     * @param string $name
     * @param string|\Closure|array $callable
     * @param int $priority
     *
     * @return \FishyMinds\WordPress\Plugin\Extension
     */
    abstract public function add($name, $callable, $priority = 10);

    abstract protected function readFile();

    /**
     *
     */
    public function load()
    {
        $this->readFile();

        foreach ($this->extensions as $extension) {
            $extension->add();
        }
    }

    /**
     * @param $callable
     *
     * @return string|\Closure|array
     */
    protected function resolve($callable)
    {
        if (is_array($callable) && count($callable) != 2) {
            throw new InvalidArgumentException('Invalid callable');
        }

        if (is_string($callable) && strpos($callable, '@') !== false) {
            list($class, $method) = explode('@', $callable);
            $class = $this->plugin->getNamespace() . '\\' . $class;

            if (! class_exists($class)) {
                throw new InvalidArgumentException('Class does not exists.');
            }

            $object = new $class($this->plugin);
            $callable = [$object, $method];
        }

        return $callable;
    }

    /**
     * Determine how many parameters callable has.
     *
     * @param string|\Closure|array $callable
     *
     * @return integer
     */
    protected function determineParametersNumber($callable)
    {
        if (is_string($callable) || is_closure($callable)) {
            $reflection = new ReflectionFunction($callable);

            return $reflection->getNumberOfParameters();
        }

        $reflection = new ReflectionMethod($callable[0], $callable[1]);

        return $reflection->getNumberOfParameters();
    }
}
