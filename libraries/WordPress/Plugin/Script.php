<?php

namespace FishyMinds\WordPress\Plugin;

class Script
{
    use HasPlugin;

    private $handler;
    private $source;
    private $dependencies = [];
    private $version = '';
    private $localization = [];
    private $in_footer = true;
    private $condition;

    /**
     * Script constructor.
     *
     * @param \FishyMinds\WordPress\Plugin\Plugin $plugin
     * @param string $handler
     */
    public function __construct(Plugin $plugin, $handler)
    {
        $this->plugin = $plugin;
        $this->handler = $handler;
        $this->condition = function () { return true; };
    }

    public function enqueue()
    {
        if (! call_user_func($this->condition)) {
            return;
        }

        wp_enqueue_script($this->handler, $this->source, $this->dependencies, $this->version, $this->in_footer);

        if (! empty($this->localization)) {
            global $post;

            wp_localize_script($this->handler, $this->plugin->getSlug(), $this->localization);

            wp_localize_script($this->handler, 'Post', ['id' => $post->ID]);
        }
    }

    public function source($file)
    {
        $this->source = $this->plugin->getUrl() . '/assets/js/' . $file;

        return $this;
    }

    public function dependencies($list)
    {
        $this->dependencies = $list;

        return $this;
    }

    public function version($value)
    {
        $this->version = $value;

        return $this;
    }

    public function localize($data)
    {
        $this->localization = $data;

        return $this;
    }

    public function condition($predicate)
    {
        $this->condition = $predicate;

        return $this;
    }
}