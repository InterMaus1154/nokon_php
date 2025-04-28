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
        return view('greeting', [
            'username' => $this->username,
            'email' => $this->email
        ]);
    }

    public function testQuery()
    {
        echo $this->request->isEmpty();
    }
}