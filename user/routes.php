<?php

use Core\routing\RouteStorage;

// You can define your own routes in the method below
// Do not remove the return statement at the end of the method

return new class extends RouteStorage {

    public function registerRoutes(): self
    {
        $this->get('/', function(){
            return \Core\View::prepare('greeting');
        });
        return $this;
    }
};