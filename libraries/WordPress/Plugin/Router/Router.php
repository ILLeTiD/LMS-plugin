<?php

namespace FishyMinds\WordPress\Plugin\Router;

use FishyMinds\WordPress\Plugin\HasPlugin;

class Router
{
    use HasPlugin;

    private $routes = [];

    public function loadRoutes()
    {
        $this->readFile();

        foreach ($this->routes as $uri => $route) {
            add_rewrite_rule("^{$uri}/?", "index.php?route={$uri}", 'top');
        }
    }

    public function routeRequest()
    {
        global $wp_query;

        $route = $wp_query->get('route');
        $method = $_SERVER['REQUEST_METHOD'];

        if (
            empty($route) ||
            ! array_key_exists($route, $this->routes) ||
            ! array_key_exists($method, $this->routes[$route])
        ) {
            return;
        }


        $controller = $this->routes[$route][$method]['controller'];
        $action = $this->routes[$route][$method]['action'];

        $controller = $this->plugin->getNamespace() . '\\Controllers\\' . $controller;

        if ( ! class_exists($controller)) {
            // Controller not found.
            $this->routeNotFound();
        }

        $controller = new $controller($this->plugin);

        if ( ! method_exists($controller, $action)) {
            // Action not found.
            $this->routeNotFound();
        }


        $controller->$action();
        die;
    }

    public function whitelistRouteParameter($query_vars)
    {
        $query_vars[] = 'route';

        return $query_vars;
    }

    private function readFile()
    {
        $file = $this->plugin->getDirectory('/extensions/routes.php');

        if (file_exists($file)) {
            extract([
                'route' => $this,
                'plugin' => $this->plugin
            ]);

            require_once $file;
        }
    }

    private function get($uri, $action)
    {
        $this->addRoute('GET', $uri, $action);
    }

    private function post($uri, $action)
    {
        $this->addRoute('POST', $uri, $action);
    }

    private function addRoute($method, $uri, $action)
    {
        list($controller, $action) = explode('@', $action);

        $controller =  str_replace('/', '\\', $controller);

        $this->routes[$uri][$method]['controller'] = $controller;
        $this->routes[$uri][$method]['action'] = $action;
    }

    private function routeNotFound()
    {
        global $wp_query;

        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        die;
    }
}