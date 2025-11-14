<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        // Path único para la página actual
        $path = '/' . trim(uri_string(), '/');

        // SESSIONS: usar helper/session service
        $session = session();
        $sessionKey = 'visits' . ($path === '/' ? '_home' : '_' . md5($path));
        $sessionVisits = $session->get($sessionKey) ?? 0;
        $sessionVisits++;
        $session->set($sessionKey, $sessionVisits);

        // COOKIES: registrar última visita
        $cookieName  = 'last_visit';
        $cookieValue = date('c');
        // 30 días = 30*86400 segundos
        service('response')->setCookie($cookieName, $cookieValue, 30 * 86400);

        // GLOBAL: persistir contador mediante modelo
        $visitModel = new \App\Models\VisitModel();
        $visitModel->increment($path);
        $globalVisits = $visitModel->getCount($path);
        $totalVisits  = $visitModel->getTotal();

        $data = [
            'sessionVisits' => $sessionVisits,
            'globalVisits'  => $globalVisits,
            'totalVisits'   => $totalVisits,
        ];
        
        return view('layouts/header') 
            . view('homeView') 
            . view('layouts/footer');
    }
}
