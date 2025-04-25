<?php

use Core\Routing\RouteStorage;
use Core\View;
use User\App\Controllers\TestController;

// You can define your own routes in the method below
// Do not remove the return statement at the end of the method

return new class extends RouteStorage {

    public function registerRoutes(): self
    {
        $this->get('/', [TestController::class, 'index']);
        $this->post('/submit', [TestController::class, 'submitForm']);
        return $this;
    }
};