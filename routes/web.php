<?php

use Core\Route;
use Core\Redirect;
use Core\View;
use Core\Response;

Route::get('/', function () {
    return View::prepare('dashboard');
});


Route::post('/test', function(){
    echo "test";
});