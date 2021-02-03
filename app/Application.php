<?php

namespace App;

class Application
{
    public function boot()
    {
        echo view('index', ['test' => 'world!']);
    }
}
