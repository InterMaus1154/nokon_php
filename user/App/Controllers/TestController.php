<?php

namespace User\App\Controllers;

use Core\Request\Request;
use Core\View;

class TestController
{
    public function __construct()
    {
        $this->request = new Request();
    }

    public function index()
    {
        return view('greeting');
    }

    public function submitForm()
    {
        echo $this->request->input('username', 'alma');
    }
}