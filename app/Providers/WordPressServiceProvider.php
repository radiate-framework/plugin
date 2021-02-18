<?php

namespace Plugin\Providers;

use Radiate\Foundation\Providers\WordPressServiceProvider as ServiceProvider;

class WordPressServiceProvider extends ServiceProvider
{
    /**
     * The custom post types and taxonomies to register
     *
     * @var array
     */
    protected $postTypes = [
        //
    ];

    /**
     * The shortcodes to register
     *
     * @var array
     */
    protected $shortcodes = [
        //
    ];
}
