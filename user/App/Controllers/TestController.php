<?php

namespace User\App\Controllers;

use Core\Request\Request;
use Core\View;
use User\App\Controllers\HasRequestHelpers;

class TestController extends NokonBaseController
{
    use HasRequestHelpers;
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
        echo "<pre>";
        print_r($this->request->except('password'));
        echo "</pre>";
    }

    public function testQuery()
    {
        echo $this->request->query('testQuery');
    }
}