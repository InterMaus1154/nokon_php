<?php

namespace User\App\Controllers;

use Core\Request\Request;

abstract class NokonBaseController
{
    protected Request $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function __get(string $name)
    {
        return $this->request->input($name);
    }


}