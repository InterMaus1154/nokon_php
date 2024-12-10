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
    $testValue = 4;
    session()->put('test-value', $testValue);

    $storedValue = session('test-value', -1);
    echo $storedValue;

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