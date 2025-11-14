<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nombre',
        'apellido',
        'email',
        'password',
        'telefono',
        'unidad',
        'tipo_usuario',
        'estado',
        'fecha_registro',
        'ultima_conexion',
        'token_recuperacion',
        'foto_perfil'
    ];

    // No usa timestamps nativos (created_at / updated_at)
    protected $useTimestamps = false;

    // Reglas de validación
    protected $validationRules = [
        'nombre'        => 'required|min_length[2]',
        'apellido'      => 'required|min_length[2]',
        'email'         => 'required|valid_email',
        'password'      => 'permit_empty|min_length[6]',
    ];

    protected $validationMessages = [];
}
