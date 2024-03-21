<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table      = 'pemesanan';
    protected $allowedFields = ['MemberID', 'PenjagaID', 'Durasi', 'JenisPS', 'TanggalPemesanan', 'WaktuBerakhir', 'TotalBiaya'];
    protected $primaryKey = 'PemesananID';

    public function getBooking($id = false)
    {
        if ($id == false) {
            $sql = "SELECT *, member.Nama as NamaMember, penjaga.Nama as NamaStaff FROM pemesanan, member, inventaris, penjaga
            WHERE pemesanan.MemberID = member.MemberID
            AND pemesanan.JenisPS = inventaris.BarangID
            AND pemesanan.PenjagaID = penjaga.PenjagaID
            ORDER BY pemesanan.TanggalPemesanan DESC";

            return $this->db->query($sql)->getResultArray();
        }

        $sql = "SELECT *, member.Nama as NamaMember, penjaga.Nama as NamaStaff 
        FROM pemesanan
        JOIN member ON pemesanan.MemberID = member.MemberID
        JOIN inventaris ON pemesanan.JenisPS = inventaris.BarangID
        JOIN penjaga ON pemesanan.PenjagaID = penjaga.PenjagaID
        WHERE pemesanan.PemesananID = ?";

        return $this->db->query($sql, [$id])->getRow();
        // return $this->where(['PemesananID' => $id])->first();
    }

    public function updateStatus($id)
    {
        $sql = "UPDATE pemesanan SET StatusPemesanan = 'Selesai' WHERE PemesananID = ?";
        $this->db->query($sql, [$id]);
    }
}
