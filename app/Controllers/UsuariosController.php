<?php


namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;
/**
 * @property \CodeIgniter\HTTP\IncomingRequest $request
 */

class UsuariosController extends ResourceController
{
    protected $modelName = UsuarioModel::class;
    protected $format    = 'json';
    
    public function get()
    {
        return $this->respond($this->model->findAll());
    }
    
    public function show($id = null)
    {
        $usuario = $this->model->find($id);

        if (!$usuario) {
            return $this->failNotFound('Usuario no encontrado');
        }

        return $this->respond($usuario);
    }

    public function create()
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

        if(!$this->model->find($data['email'] ?? null)) {
            return $this->failResourceGone('Usuario ya existe');
        }

        // Encriptar contraseña
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        // No guardar password_confirm
        unset($data['password_confirm']);

        $data['tipo_usuario'] = $data['tipo_usuario'] ?? 'residente'; // Valor por defecto

        if (!$this->model->insert($data)) {
            // Si el modelo tiene errores, devolverlos
            return $this->respond([
                'success' => false,
                'errors'  => $this->model->errors() ?: ['db' => 'No se pudo crear el usuario']
            ], 500);
        }

        return $this->respondCreated([
            'success' => true,
            'message' => 'Usuario creado correctamente'
        ]);
    }

    public function update($id = null)
    {
        // Intentar leer JSON
        $data = $this->request->getJSON(true);

        // Si es null, viene por POST normal
        if (!$data) {
            $data = $this->request->getPost();
        }

        // Asegurar que $data sea array
        if (!is_array($data)) {
            return $this->fail('Formato de datos inválido. Envía JSON o POST.');
        }

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        if(!$this->model->find($id)) {
            return $this->failNotFound('Usuario no encontrado');
        }

        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'message' => 'Usuario actualizado correctamente'
        ]);
    }
}
