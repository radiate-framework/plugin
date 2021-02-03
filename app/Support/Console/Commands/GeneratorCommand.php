<?php

namespace Plugin\Support\Console\Commands;

class GeneratorCommand extends Command
{
    public function __invoke($args)
    {
        $this->args = $args;

        $this->handle();
    }

    public function handle()
    {
        //
    }

    public function getName()
    {
        return $this->args[0];
    }

    public function getStub()
    {
        //
    }

    public function getNamespace()
    {
        //
    }

    public function createClass()
    {
        $str = file_get_contents($this->getStub());

        $str = str_replace('{{ class }}', $this->getName(), $str);

        $path = $this->getNamespace() . '/' . $this->getName() . '.php';

        return (bool) file_put_contents($this->app->basePath($path), $str);
    }
}
