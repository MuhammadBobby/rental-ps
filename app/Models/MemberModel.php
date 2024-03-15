<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table      = 'member';
    protected $useTimestamps = true;
    protected $allowedFields = ['Nama', 'Alamat', 'Telepon', 'Email'];

    public function getMember($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['MemberID' => $id])->first();
    }
}
