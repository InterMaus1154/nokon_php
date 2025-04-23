<?php

namespace User\App\Controllers;

use Core\View;

class TestController
{
    public function greeting()
    {
        return view('greeting');
    }
}