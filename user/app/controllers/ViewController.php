<?php

namespace user\app\controllers;

class ViewController
{
    public function index()
    {
        return view('index-2');
    }

    public function about()
    {
        return view('about');
    }
}