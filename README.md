# LMS Plugin #

The plugin activates an area in the dashboard where you are able to create and edit online courses. The courses contains of a various numbers of slides. The slides contain a custom structure where you are able to add extra several rows of text and images. The plugin will also be able to handle users invites and tracking the users participating in courses.

## Plugin structure ##

### File and directory structure: ###

* assets/ (dashboard assets)
* extensions/
    * actions.php (the file where custom actions are added)
    * filters.php (the file where custom filters are added)
    * routes.php (the file where custom routes are added)
* frontend/
* languages/
* libraries/
* templates/ (directory for front-end templates)
* views/ (directory for dashboard templates)
* autoload.php 
* lms-plugin.php (main plugin's file and entry point)


## Adding a new action ##

The `extensions/actions.php` contains all plugin's custom actions.

```php
$action->add($hook_name, $callable, $priority);
```

* $hook_name
    (string) (Required) The name of the action to which the $callable is hooked.
* $callable
    (string|array|callable) (Required) Callable, either of four: 
    * Function name
    * Anonymous function
    * Array where first element is class name or object and second - method name
    * Class name and method name separated by @
* $priorit
    (int) (Optional) Used to specify the order in which the functions associated with a particular action are executed. Lower numbers correspond with earlier execution, and functions with the same priority are executed in the order in which they were added to the action.
        *Default value: 1*

**We don't need to pass number of argument, because they'll be determined using reflection**

### Examples ###

```php

$action->add('init', 'some_function');

$action->add('init', function () {
    // Do something.
});

// Add static method `load` of `StyleLoader` class.
$action->add('wp_enqueue_scripts', [StyleLoader::class, 'load']);

// Add dynamic method `load` of `StyleLoader` class.
$action->add('wp_enqueue_scripts', [new StyleLoader, 'load']);

// This will create an instace of `StyleLoader` class and hook load method. 
$action->add('wp_enqueue_scripts', 'StyleLoader@load');

```

## Adding a new filter ##

The `extensions/filters.php` contains all plugin's custom filters.

```php
$action->add($hook_name, $callable, $priority);
```

* $hook_name
    (string) (Required) The name of the action to which the $callable is hooked.
* $callable
    (string|array|callable) (Required) Callable, either of four: 
    * Function name
    * Anonymous function
    * Array where first element is class name or object and second - method name
    * Class name and method name separated by @
* $priorit
    (int) (Optional) Used to specify the order in which the functions associated with a particular action are executed. Lower numbers correspond with earlier execution, and functions with the same priority are executed in the order in which they were added to the action.
        *Default value: 1*

**We don't need to pass number of argument, because they'll be determined using reflection**

### Examples ###

```php

// Add a function.
$filter->add('custom_menu_order', '__return_true');

// Add a closure.
$filter->add('body_class', function ($classes) {
    $classes .= ' lms-plugin-body';    

    return $classes;
});

// Add a static method `changeOrder` of `DashboardMenu` class.
$action->add('menu_order', [DashboardMenu::class, 'changeOrder']);

// Add a dynamic method `changeOrder` of `DashboardMenu` class.
$filter->add('menu_order', [new DashboardMenu, 'changeOrder']);

// This will create an instace of `DashboardMenu` class and hook `changeOrder` method. 
$filter->add('menu_order', 'DashboardMenu@changeOrder');

```


## Releasing a new version ##

First of all, we need to change plugin version in `lms-plugin.php`.

Then tag commit with a new version:

```bash
git tag [version]
```

Push changes with tags to remote repository:

```bash
git push && git push --tags
```