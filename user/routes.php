<?php

return new class extends \Core\RouteStorage {
    public function registerRoutes(): self
    {
        $this->get('/', function(): \Core\Renderable{
            return view('index');
        });

        $this->get('/test', [\user\ViewController::class, 'show']);

        return $this;
    }
};