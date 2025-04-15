<?php
session_start();

require "core/helper.php";
require "core/view.php";
require "core/App.php";
require "core/Router.php";
require "core/Route.php";
require "core/Redirect.php";
require "core/Session.php";
require "core/Response.php";
require "core/helper_return.php";
require "core/ExceptionHandler.php";
require 'core/RouteStorage.php';
require 'core/RequestMethod.php';

use Core\App;
use Core\Router;
use Core\Redirect;
use Core\Session;
use Core\Response;
use Core\ExceptionHandler;
use Core\RouteStorage;

$app = App::getInstance();
//
$app->registerService('router', Router::getInstance());
//$app->registerService('redirect', Redirect::getInstance());
//$app->registerService('session', Session::getInstance());
//$app->registerService('response', Response::getInstance());
//$app->registerService('nokonExceptionHandler', (new \Core\ExceptionHandler()));


$routeStorage = (require 'user/routes.php')->registerRoutes();
$app->run($routeStorage);
//print_r(count($user->getRoutes()));
//echo $user->getRoutes()[0]->getRouteString();