<?php
session_start();


require_once 'core/interfaces/Renderable.php';
require_once 'core/interfaces/Runnable.php';
require_once 'core/helpers/ServiceSingleton.php';
require_once "core/View.php";
require_once "core/App.php";
require_once "core/routing/Router.php";
require_once "core/routing/Route.php";
require_once 'core/routing/RouteStorage.php';
require_once 'core/enums/RequestMethod.php';

require_once 'core/helpers/helper.php';

use Core\App;
use core\routing\Router;

// TEMP
// load all files from user folder
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__.'/user'));
$files = new RegexIterator($iterator, '/\.php$/');

foreach ($files as $file){
    require_once $file->getPathname();
}

// exception handling will be improved later
try{
    App::getInstance()
        ->with('routeStorage', (require 'user/routes.php')->registerRoutes())
        ->with('router', Router::getInstance())
        ->run();
}catch(Exception $e){
    http_response_code(500);
    echo "An internal error occurred!";
    echo $e->getMessage();
    exit;
}

