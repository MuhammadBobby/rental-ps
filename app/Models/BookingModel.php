<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table      = 'pemesanan';
    protected $useTimestamps = true;
    protected $allowedFields = ['TanggalPemesanan', 'MemberID', 'PenjagaID', 'Durasi', 'JenisPS', 'TotalBiaya'];

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
}