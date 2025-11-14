<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
/**
 * @property \CodeIgniter\HTTP\IncomingRequest $request
 */

class DashboardController extends ResourceController
{
    public function index(): string
    {
        // Path fijo para el dashboard
        $path = '/dashboard';

        // Sesión: contar visitas en la sesión por página
        $session = session();
        $sessionKey = 'visits' . md5($path);
        $sessionVisits = $session->get($sessionKey) ?? 0;
        $sessionVisits++;
        $session->set($sessionKey, $sessionVisits);

        // Cookie: marca la última visita (30 días)
        $cookieName = 'last_visit_dashboard';
        $cookieValue = date('c');
        service('response')->setCookie($cookieName, $cookieValue, 30 * 86400);

        // Modelo: persistir contador global
        $visitModel = new \App\Models\VisitModel();
        $visitModel->increment($path);
        $globalVisits = $visitModel->getCount($path);
        $totalVisits  = $visitModel->getTotal();

        $data = [
            'sessionVisits' => $sessionVisits,
            'globalVisits'  => $globalVisits,
            'totalVisits'   => $totalVisits,
        ];
        
        return view('layouts/innerHeader') 
            . view('dashboardView') 
            . view('layouts/innerFooter');
    }

    public function getVisits()
    {
        // sesión
        $session = session();
        $sessionKey = 'visits' . md5('/dashboard');
        $sessionVisits = (int) ($session->get($sessionKey) ?? 0);

        // modelo de visitas
        $visitModel = new \App\Models\VisitModel();
        $globalVisits = $visitModel->getCount('/dashboard');
        $totalVisits  = $visitModel->getTotal();

        $data = [
            'sessionVisits' => $sessionVisits,
            'globalVisits'  => $globalVisits,
            'totalVisits'   => $totalVisits,
        ];

        return $this->respond($data, 200);
    }
}
