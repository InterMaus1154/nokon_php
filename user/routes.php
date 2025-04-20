<?php

use core\routing\RouteStorage;
use user\app\controllers\ViewController;

return new class extends RouteStorage {
    public function registerRoutes(): self
    {
        $this->get('/', function(){
            return view('index');
        });

        $this->get('/test', [ViewController::class, 'index']);
        $this->get('/about', [ViewController::class, 'about']);

        return $this;
    }
};