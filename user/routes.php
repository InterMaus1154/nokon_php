<?php

use Core\routing\RouteStorage;

// You can define your own routes in the method below
// Do not remove the return statement at the end of the method

return new class extends RouteStorage {

    public function registerRoutes(): self
    {

        return $this;
    }
};