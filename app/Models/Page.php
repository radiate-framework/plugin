<?php

namespace Plugin\Models;

use Radiate\Database\Models\Post as Model;

class Page extends Model
{
    /**
     * The post type
     *
     * @var string
     */
    protected static $postType = 'page';
}
