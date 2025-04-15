<?php

use core\RequestMethod;

return new class extends \Core\RouteStorage {
    public function registerRoutes(): self
    {
        $this->get('/', function(): \Core\Renderable{
            return \Core\View::prepare('index');
        });


        return $this;
    }
};