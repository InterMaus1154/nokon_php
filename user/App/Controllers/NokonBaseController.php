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
}