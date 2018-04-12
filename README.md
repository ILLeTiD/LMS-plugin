# LMS Plugin

The plugin activates an area in the dashboard where you are able to create and edit online courses. The courses contains of a various numbers of slides. The slides contain a custom structure where you are able to add extra several rows of text and images. The plugin will also be able to handle users invites and tracking the users participating in courses.

## Directory structure

* assets/ 
    * scripts.php
    * styles.php
* extensions/
    * actions.php 
    * filters.php 
    * routes.php 
* frontend/
* languages/
* libraries/
* templates/ 
* views/ 
* autoload.php 
* lms-plugin.php 

The `assets` directory contains styles, scripts, fonts, images and etc. Also there are `scripts.php` and `styles.php` files where you can enqueue scripts and styles respectively.

The `extensions` directory, as name implies, contains custom functionality. There is `helpers.php` where project specific helper functions are located.

The `libraries` directory contains various libraries. Also there is `helpers.php` for generic helper functions.

The `templates` directory contains front-end related views.

The `views` directory contains dashboard and authentication related views.

## Enqueuing scripts 

The `assets/scripts.php` contains all plugin's dashboard (admin) scripts.

To enqueue script specify handler and file name (relatively to `assets/js` directory):
```php
$script->add('script-handler')
       ->source('filename.js');
```

It's also possible to set script's dependencies:
```php
$script->add('script-handler')
       ->source('filename.js')
       ->dependencies(['dependency1.js', 'dependency2']);
```

If you need to enqueue the script only on specific page, use `condition` method with a predicate function:
```php
$script->add('script-handler')
       ->source('filename.js')
       ->condition(function () {
           return $this->getCurrentScreen()->id == 'course';
       });
```

## Enqueuing styles 

The `assets/styles.php` contains all plugin's dashboard (admin) styles.

To enqueue style specify handler and file name (relatively to `assets/css` directory):
```php
$style->add('style-handler', 'style.css');
```

## Adding a new action

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

### Examples

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

## Adding a new filter

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

### Examples

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

## Defining custom routes

The `extensions/routes.php` contains all plugin's custom routes.

You can specify method (GET or POST) to which route will respond by calling corresponding method on `$route` object.

The `get` and `post` methods accept two arguments: relative URL and controller/action in `Controller@action` format. Controller class name must be relative to `LmsPlugin\Contollers` namespace.
```php
$route->get('login', 'Auth/LoginController@showForm');
$route->post('login', 'Auth/LoginController@login');
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