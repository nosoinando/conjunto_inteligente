<?php

namespace App\Controllers;

use App\Models\ContactoModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\API\ResponseTrait;
/**
 * @property \CodeIgniter\HTTP\IncomingRequest $request
 */

class ContactoController extends ResourceController
{
    protected $modelName = ContactoModel::class;
    protected $format    = 'json';

    public function index(): string
    {
        return view('layouts/header') 
            . view('contactoView') 
            . view('layouts/footer');
    }

    public function get()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $contacto = $this->model->find($id);

        if (!$contacto) {
            return $this->failNotFound('Contacto no encontrado');
        }

        return $this->respond($contacto);
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

        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated([
            'message' => 'Contacto creado correctamente'
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

        if(!$this->model->find($id)) {
            return $this->failNotFound('Contacto no encontrado');
        }

        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'message' => 'Contacto actualizado correctamente'
        ]);
    }
}
