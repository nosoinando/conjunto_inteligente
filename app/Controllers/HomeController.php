<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        return view('layouts/header') 
            . view('homeView') 
            . view('layouts/footer');
    }
}
