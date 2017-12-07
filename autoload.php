<?php

spl_autoload_register(function ($name) {
    $map = [
        'FishyMinds' => 'libraries',
        'LmsPlugin' => 'extensions'
    ];

    $rootNamespace = substr($name, 0, strpos($name, '\\'));

    if (empty($map[$rootNamespace])) {
        return false;
    }

    $className = substr($name, strlen($rootNamespace));
    $file = __DIR__ . '/' . $map[$rootNamespace] . str_replace('\\', '/', $className) . '.php';

    if (file_exists($file)) {
        require_once $file;

        return true;
    }

    return false;
});