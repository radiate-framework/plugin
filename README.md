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
- Filesystem
- Views
