<?php

namespace Plugin\Support\Console\Commands;

class MakeController extends GeneratorCommand
{
    protected $command = 'make:controller';

    public function handle()
    {
        if (!$this->getName()) {
            return $this->error('Name attribute is required');
        }

        if ($this->createClass()) {
            return $this->success('Controller created');
        }
        return $this->error('Failed to create controller');
    }

    public function getStub()
    {
        return __DIR__ . '/stubs/controller.stub';
    }

    public function getNamespace()
    {
        return 'app/Http/Controllers/';
    }
}
