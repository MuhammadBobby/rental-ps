<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table      = 'penjaga';
    protected $useTimestamps = true;
    protected $allowedFields = ['Nama', 'Shift'];

    public function getStaff($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['PenjagaID' => $id])->first();
    }
}
