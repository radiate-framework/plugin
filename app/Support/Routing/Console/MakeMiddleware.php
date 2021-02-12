<?php

namespace Plugin\Support\Routing\Console;

use Plugin\Support\Console\GeneratorCommand;

class MakeMiddleware extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Middleware';

    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'make:middleware {name : The name of the middleware}
                                            {--force : Overwrite the middleware if it exists}';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Make a middleware';

    /**
     * Get the stub path.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/middleware.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace(string $rootNamespace)
    {
        return $rootNamespace . '\\Http\\Middleware';
    }
}