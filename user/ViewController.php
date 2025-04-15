<?php

namespace user;

use Core\Renderable;

class ViewController
{
    public function show(): \Core\View
    {
        return view('index-2');
    }
}