<?php

use Core\Route;
use Core\Redirect;
use Core\View;
use Core\Response;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/', function(): View|Response{
    if(true){
        return Response::raw("hello world");
    }
    return View::make('dashboard');
});