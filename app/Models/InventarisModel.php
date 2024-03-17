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

    public function countBiaya($durasi, $jenis)
    {
        // Gunakan query binding untuk mencegah SQL Injection
        $sql = "SELECT HargaPerJam FROM inventaris WHERE BarangID = ?";
        $query = $this->db->query($sql, [$jenis]);

        // Periksa apakah hasilnya ada
        if ($query->getNumRows() > 0) {
            // Ambil hasil query
            $row = $query->getRow();
            // Hitung biaya dengan mengalikan HargaPerJam dengan durasi
            $biaya = $row->HargaPerJam * $durasi;
            return $biaya;
        } else {
            // Kembalikan 0 atau nilai default lain jika tidak ditemukan
            return 0;
        }
    }
}
