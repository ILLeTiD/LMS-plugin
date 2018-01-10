<?php

namespace LmsPlugin\Controllers;

use FishyMinds\View;
use FishyMinds\WordPress\Plugin\HasPlugin;

class Controller
{
    use HasPlugin;

    protected function view($name, $variables = [])
    {
        (new View($this->plugin))
            ->template($name)
            ->with($variables)
            ->display();
    }
}