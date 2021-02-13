<?php

namespace Radiate\Support\Facades;

use Radiate\Support\Stringable;

class Str
{
    /**
     * Make a new instance of stringable
     *
     * @param string $string
     * @return \Radiate\Support\Stringable
     */
    public static function of(string $string)
    {
        return new Stringable($string);
    }

    /**
     * Dynamically call the Stringable class
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public static function __callStatic(string $method, array $parameters)
    {
        $str = (new Stringable(array_pop($parameters)))->$method(...$parameters);

        return $str instanceof Stringable ? $str->toString() : $str;
    }
}
