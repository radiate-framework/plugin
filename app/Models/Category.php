<?php

namespace Plugin\Models;

use Radiate\Database\Models\Term as Model;

class Category extends Model
{
    /**
     * The taxonomy
     *
     * @var string
     */
    protected static $taxonomy = 'category';
}
