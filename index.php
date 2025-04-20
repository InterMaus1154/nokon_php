<?php
session_start();

require "core/helper.php";
require "core/View.php";
require "core/App.php";
require "core/Router.php";
require "core/Route.php";
require 'core/RouteStorage.php';
require 'core/enums/RequestMethod.php';

use Core\App;
use Core\Router;

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