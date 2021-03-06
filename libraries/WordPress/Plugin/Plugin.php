<?php

namespace FishyMinds\WordPress\Plugin;

/**
 * @property string $date_format
 */
class Plugin
{
    /**
     * File path of the plugin.
     * @var
     */
    private $file;

    /**
     * Slug of the plugin (consist of directory name and file name).
     * @var
     */
    private $slug;

    private $prefix;

    /**
     * Absolute directory of the plugin.
     * @var string
     */
    private $directory;

    /**
     * URL of the plugin.
     * @var string
     */
    private $url;

    /**
     * @var \FishyMinds\WordPress\Plugin\Loader
     */
    private $loader;

    /**
     * Plugin data which comes from a plugin header.
     * @var
     */
    private $data;

    private $router;

    public function __construct($file)
    {
        $this->file = $file;
        $this->url = rtrim(plugin_dir_url($file), '/');
        $this->directory = dirname($file);
        $this->slug = plugin_basename($file);
        $this->prefix = basename($this->slug, '.php');
        $this->loader = new Loader($this, new ActionLoader($this), new FilterLoader($this));
    }

    public function init()
    {
        // Make sure we don't expose any info if called directly.
        if ( ! function_exists('add_action')) {
            echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
            die;
        }

        $this->loader->load();
    }

    public function __get($property)
    {
        switch ($property) {
            case 'date_format':
                return get_option('date_format');
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->slug;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get directory.
     *
     * @return string
     */
    public function getDirectory($path = '')
    {
        return $this->directory . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }

    /**
     * Get URL.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get version.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->getData('Version');
    }

    /**
     * Get plugin header data.
     *
     * @param string $name
     *
     * @return string
     */
    public function getData($name = '')
    {
        if (empty($this->data)) {
            $this->data = get_plugin_data($this->file);
        }

        return $this->data[$name] ?: '';
    }

    /**
     * Get namespace of the plugin components.
     *
     * @return string
     */
    public function getNamespace()
    {
        return studly_case(basename($this->slug, '.php'));
    }

    public function getPrefix($ending = '')
    {
        return $ending ? $this->prefix . '_' . $ending : $this->prefix;
    }

    public function getOption($name = '', $default = [])
    {
        return get_option($this->getPrefix($name), $default);
    }

    public function setOption($name, $value)
    {
        return update_option($this->getPrefix($name), $value);
    }

    /**
     * Get settings of the plugin.
     *
     * @param string|null $option
     *
     * @return mixed
     */
    public function getSettings($option = null)
    {
        $default = [
            'colors' => [
                'background' => '#4990E2',
                'header' => '#f1f1f1',
                'text' => '#ffffff'
            ],
            'register' => [
                'restriction' => '',
                'support' => '1'
            ]
        ];

        $settings = get_option(basename($this->slug, '.php'), $default);

        return $option ? array_get($settings, $option) : $settings;
    }

    /**
     * Set settings of the plugin.
     *
     * @param array $settings
     *
     * @return bool
     */
    public function setSettings($settings)
    {
        return update_option(basename($this->slug, '.php'), $settings);
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }
}
