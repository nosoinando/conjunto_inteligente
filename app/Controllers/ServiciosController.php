<?php

namespace App\Controllers;

class ServiciosController extends BaseController
{
    public function index(): string
    {
        return view('layouts/header') 
            . view('serviciosView') 
            . view('layouts/footer');
    }
}
