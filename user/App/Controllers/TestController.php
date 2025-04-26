<?php

namespace User\App\Controllers;

use Core\Request\Request;
use Core\View;

class TestController extends NokonBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('greeting');
    }

    public function submitForm()
    {
        echo $this->request->input('username', 'alma');
    }

    public function testQuery()
    {
        echo $this->request->query('testQuery');
    }
}