<?php

namespace App\Controllers;

class ContactoController extends BaseController
{
    public function index(): string
    {
        return view('layouts/header') 
            . view('contactoView') 
            . view('layouts/footer');
    }
}
