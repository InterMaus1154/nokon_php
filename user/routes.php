<?php

return new class extends \Core\RouteStorage {
    public function registerRoutes(): self
    {
        $this->get('/', function(){
            return view('index');
        });

        $this->get('/test', function(){

        });

        return $this;
    }
};