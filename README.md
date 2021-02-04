# WP Base Plugin

A WordPress plugin boilerplate

## Installation

From the `plugins` directory of your site:

```bash
composer create-project brw/wp-base-plugin plugin-name
```

It is highly recommended to change the plugin namespace to avoid clashes with other plugins.

## Service Providers

Service providers can be created with the following `wp-cli` command:

```bash
wp plugin-cli make:provider MyPluginServiceProvider
```

Once created, they should be registered in `index.php`.

The core services provided by the plugin are:

- Console
- Events
- Filesystem
- Views

## Events

The Event Dispatcher utilizes WordPress add/apply filters So you can create listener classes to listen to core, theme and plugin actions.

```php
<?php

// listen to a WP core event
$app['events']->listen('admin_init', Plugin\Listeners\AdminInit::class);

// listen to a custom event
$app['events']->listen(CustomEvent::class, Plugin\Listeners\EventListener::class);

// Dispatch a custom event
$app['events']->dispatch(CustomEvent::class);

// Dispatch a custom event
CustomEvent::dispatch('Hello world!');

// or use the helper function
Plugin\event('custom_event', 'Hello world!')

```

You can create Events, Listeners and Subscribers with the CLI:

```
wp plugin-cli make:event CustomEvent

wp plugin-cli make:listener EventListener

wp plugin-cli make:subscriber EventSubscriber
```
