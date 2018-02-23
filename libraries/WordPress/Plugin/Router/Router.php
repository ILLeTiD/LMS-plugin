<?php

namespace FishyMinds\WordPress\Plugin\Router;

use FishyMinds\Request;
use FishyMinds\WordPress\Plugin\HasPlugin;
use ReflectionClass;

class Router
{
    use HasPlugin;

    private $routes = [];

    public function registerRoutes()
    {
        $this->readFile();

        foreach ($this->routes as $uri => $route) {
            add_rewrite_rule("^{$uri}/?", "index.php?route={$uri}", 'top');
        }
    }

    public function routeRequest()
    {
        global $wp_query;

        // $this->readFile();

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

        try {
            $controllerReflection = new ReflectionClass($controller);
            $controller = new $controller($this->plugin);
            $actionReflection = $controllerReflection->getMethod($action);

            if ($actionReflection->getNumberOfParameters()) {
                $controller->$action(new Request($_REQUEST));
            } else {
                $controller->$action();
            }
        } catch (\ReflectionException $exception) {
            $this->routeNotFound();
        }

        die;
    }

    public function whitelistRouteParameter($query_vars)
    {
        $query_vars[] = 'route';

        return $query_vars;
    }

    private function readFile()
    {
        $file = $this->plugin->getDirectory('extensions/routes.php');

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