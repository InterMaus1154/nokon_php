<?php

return new class extends \Core\RouteStorage {
    public function registerRoutes(): self
    {
        $this->get('/', function(){
            return \Core\View::prepare('index');
        });

        $this->get('/test', [\user\ViewController::class, 'show']);
        $this->post('/submit', [\user\ViewController::class, 'submit']);

        return $this;
    }
};