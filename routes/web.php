<?php

use core\RequestMethod;

return new class extends \Core\RouteStorage {
    public function registerRoutes(): self
    {
        $this->route(RequestMethod::GET, '/', function(){

        });

        return $this;
    }
};