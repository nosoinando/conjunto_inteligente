<?php
namespace App\Models;

use CodeIgniter\Model;

class VisitModel extends Model
{
    protected $table = 'visitas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['path', 'count', 'last_visit'];

    public function increment(string $path): array
    {
        $now = date('Y-m-d H:i:s');
        $builder = $this->db->table($this->table);

        // Intentar actualizar; si no existe, insertar
        $builder->set('count', 'count+1', false)
                ->set('last_visit', $now)
                ->where('path', $path)
                ->update();

        if ($this->db->affectedRows() === 0) {
            $this->insert(['path' => $path, 'count' => 1, 'last_visit' => $now]);
            return $this->where('path', $path)->first();
        }

        return $this->where('path', $path)->first();
    }

    public function getCount(string $path): int
    {
        $row = $this->where('path', $path)->first();
        return $row ? (int) $row['count'] : 0;
    }

    public function getTotal(): int
    {
        $res = $this->selectSum('count', 'total')->first();
        return (int) ($res['total'] ?? 0);
    }
}