<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table      = 'pemesanan';
    protected $allowedFields = ['MemberID', 'PenjagaID', 'Durasi', 'JenisPS', 'TotalBiaya'];
    protected $primaryKey = 'PemesananID';

    public function getBooking($id = false)
    {
        if ($id == false) {
            $sql = "SELECT *, member.Nama as NamaMember, penjaga.Nama as NamaStaff FROM pemesanan, member, inventaris, penjaga
            WHERE pemesanan.MemberID = member.MemberID
            AND pemesanan.JenisPS = inventaris.BarangID
            AND pemesanan.PenjagaID = penjaga.PenjagaID";

            return $this->db->query($sql)->getResultArray();
        }

        return $this->where(['PemesananID' => $id])->first();
    }

    public function countBiaya($durasi, $jenis)
    {
        // Gunakan query binding untuk mencegah SQL Injection
        $sql = "SELECT HargaPerJam FROM inventaris WHERE Jenis = ?";
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
