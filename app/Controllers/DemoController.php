<?php

namespace App\Controllers;

class DemoController extends BaseController
{
    public function index(): string
    {
        return view('layouts/header') 
            . view('demoView') 
            . view('layouts/footer');
    }
}
