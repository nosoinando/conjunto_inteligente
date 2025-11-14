<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactoModel extends Model
{
    protected $table            = 'contactos';
    protected $primaryKey       = 'id';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nombre_completo',
        'email',
        'unidad',
        'notas'
    ];

    // No usa timestamps nativos (created_at / updated_at)
    protected $useTimestamps = false;

    // Reglas de validación
    protected $validationRules = [
        'nombre_completo'        => 'required|min_length[4]',
        'email'         => 'required|valid_email',
        'unidad'      => 'permit_empty|min_length[4]',
        'notas'      => 'permit_empty|min_length[4]',
    ];

    protected $validationMessages = [];
}
