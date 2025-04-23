<?php

use Core\Routing\RouteStorage;
use Core\View;

// You can define your own routes in the method below
// Do not remove the return statement at the end of the method

return new class extends RouteStorage {

    public function registerRoutes(): self
    {
        $this->get('/', function(){
            return View::prepare('greeting');
        });
        return $this;
    }
};