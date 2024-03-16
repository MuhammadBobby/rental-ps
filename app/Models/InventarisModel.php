<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarisModel extends Model
{
    protected $table      = 'inventaris';
    protected $allowedFields = ['NamaBarang', 'Jenis', 'Status', 'HargaPerJam'];
    protected $primaryKey = 'BarangID';

    public function getInventaris($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['BarangID' => $id])->first();
    }
}
