<?php

namespace App\Controllers;

class TarifasController extends BaseController
{
    public function index(): string
    {
        return view('layouts/header') 
            . view('tarifasView') 
            . view('layouts/footer');
    }
}