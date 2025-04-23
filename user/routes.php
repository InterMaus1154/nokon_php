<?php

use core\routing\RouteStorage;
use user\app\controllers\ViewController;

return new class extends RouteStorage {
    public function registerRoutes(): self
    {


        return $this;
    }
};