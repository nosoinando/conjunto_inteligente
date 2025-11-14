<?php

namespace App\Controllers;

use App\Models\ContactoModel;
use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;
/**
 * @property \CodeIgniter\HTTP\IncomingRequest $request
*/

class AuthController extends ResourceController
{
    protected $modelName = ContactoModel::class;
    protected $format    = 'json';

    public function index(): string
    {
        return view('layouts/header')
            .view('loginView') 
            .view('layouts/footer');
    }

    public function register(): string
    {
        return view('layouts/header')
            .view('registroView') 
            .view('layouts/footer');
    }

    public function login()
    {
        $data = null;
        $contentType = $this->request->getHeaderLine('Content-Type');
        if ($contentType && stripos($contentType, 'application/json') !== false) {
            try {
                $data = $this->request->getJSON(true);
            } catch (\Throwable $e) {
                $data = null;
            }
        }

        // Si es null, viene por POST normal
        if (!$data) {
            $data = $this->request->getPost();
        }

        // Asegurar que $data sea array
        if (!is_array($data)) {
            return $this->fail('Formato de datos inválido. Envía JSON o POST.');
        }

        $identifier = $data['email'] ?? null;
        $password   = $data['password'] ?? null;

        if (!$identifier || !$password) {
            return $this->fail('Se requiere email/username y password', 400);
        }

        $usuarioModel = new UsuarioModel();
        $user = $usuarioModel->where('email', $identifier)
                             ->first();

        if (!$user) {
            return $this->failNotFound('Usuario no encontrado');
        }

        if (!isset($user['password']) || !password_verify($password, $user['password'])) {
            return $this->failUnauthorized('Credenciales inválidas');
        }

        // No devolver la contraseña
        unset($user['password']);

        return $this->respond([
            'message' => 'Inicio de sesión exitoso',
            'user'    => $user
        ]);
    }

    public function logout()
    {
        // Aquí podrías destruir la sesión o el token de autenticación
        return $this->respond([
            'message' => 'Cierre de sesión exitoso'
        ]);
    }
}