<?php
session_start();

require __DIR__. '/vendor/autoload.php';

use Core\App;
use Core\routing\Router;

// exception handling will be improved later
try{
    App::getInstance()
        ->with('routeStorage', (require 'user/routes.php')->registerRoutes())
        ->with('router', Router::getInstance())
        ->run();
}catch(Exception $e){
    if(http_response_code() == 200){
        http_response_code(500);
    }
    echo "An internal error occurred! </br>";
    echo "Status: " . http_response_code() . "</br>";
    echo $e->getMessage();
    exit;
}

