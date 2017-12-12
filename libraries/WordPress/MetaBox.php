<?php

namespace FishyMinds\WordPress;

use FishyMinds\View;
use FishyMinds\WordPress\Plugin\HasPlugin;

abstract class MetaBox
{
    use HasPlugin;

    protected $id;
    protected $title;
    protected $screen = 'post';
    protected $context = 'advanced';
    protected $priority = 'default';

    public function add()
    {
        add_meta_box(
            $this->id,
            __($this->title, 'lms-plugin'),
            [$this, 'callback'],
            $this->screen,
            $this->context,
            $this->priority
        );
    }

    abstract public function callback();

    protected function view($name, $variables = [])
    {
        (new View($this->plugin))
            ->template($name)
            ->with($variables)
            ->display();
    }
}