<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarisModel extends Model
{
    protected $table      = 'inventaris';
    protected $useTimestamps = true;
    protected $allowedFields = ['NamaBarang', 'Jenis', 'Status'];

    public function getInventaris($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['BarangID' => $id])->first();
    }
}
