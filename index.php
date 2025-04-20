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

$app = App::getInstance();

$app->registerService('router', Router::getInstance());

$routeStorage = (require 'user/routes.php')->registerRoutes();
$app->with('routeStorage', $routeStorage)->run();