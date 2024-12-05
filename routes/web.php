<?php

use Core\Route;

Route::get('/', function(){
    view('dashboard');
});

Route::get('/team', function (){
    view('team');
});

Route::get('/projects', function(){
    view('projects');
});

Route::post('/test', function(){
    redirect("/submitted");
});

Route::get('/submitted', function(){
   echo "Thanks for submitting";
});

app()->removeService('router');