<?php

use Core\Route;
use Core\Redirect;

Route::get('/', function () {
    view('dashboard');
});

Route::get('/team', function () {
    view('team');
});

Route::get('/projects', function () {
    view('projects');
});

Route::get('/test', function () {
    $height = 5;
    app('session')->put('height', $height);
    echo app('session')->get('height');

});

Route::get('/submitted', function () {
    echo "Thanks for submitting";
});

Route::get('/hello-world', function () {
    echo "hello world";
});

Route::get('/redirected', function () {
    redirect()->back()->withMessage('test', 'hello2');
});