<?php


namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\API\ResponseTrait;
/**
 * @property \CodeIgniter\HTTP\IncomingRequest $request
 */
class UsuariosController extends ResourceController
{
    protected $modelName = UsuarioModel::class;
    protected $format    = 'json';
    public function index()
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

    // Encriptar contraseña
    if (isset($data['password'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
    }

    if (!$this->model->insert($data)) {
        return $this->failValidationErrors($this->model->errors());
    }

    return $this->respondCreated([
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

    if (!$this->model->update($id, $data)) {
        return $this->failValidationErrors($this->model->errors());
    }

    return $this->respond([
        'message' => 'Usuario actualizado correctamente'
    ]);
}

}
