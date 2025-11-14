<?php

namespace App\Controllers;

class PoliticaController extends BaseController
{
    public function index(): string
    {
        return view('layouts/header') 
            . view('politicaView') 
            . view('layouts/footer');
    }
}
