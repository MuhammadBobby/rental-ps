<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\InventarisModel;
use App\Models\MemberModel;
use App\Models\StaffModel;

class Booking extends BaseController
{

    protected $bookingModel;
    protected $memberModel;
    protected $staffModel;
    protected $inventarisModel;

    // construct untuk db
    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->memberModel = new MemberModel();
        $this->staffModel = new StaffModel();
        $this->inventarisModel = new InventarisModel();
    }

    public function index(): string
    {
        $data = [
            'title' => "Dashboard | Booking Transaction",
            'booking' => $this->bookingModel->getBooking()
        ];
        return view('pages/booking/index', $data);
    }

    // create
    public function create()
    {
        $data = [
            'title' => "Dashboard | Create Data",
            'validation' => \Config\Services::validation(),
            'members' => $this->memberModel->getMember(),
            'staffs' => $this->staffModel->getStaff(),
            'inventaris' => $this->inventarisModel->getInventaris()
        ];
        return view('pages/booking/create', $data);
    }

    // save
    public function save()
    {
        // validation
        $rules = [
            'MemberID' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Member of the booking item must be filled in.',
                ]
            ],
            'PenjagaID' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Staff of the booking item must be filled in.',
                ]
            ],
            'Durasi' =>  [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'The Duration of the booking item must be filled in.',
                    'numeric' => 'The Duration of the booking item must be numeric.',
                ]
            ],
            'JenisPS' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Type Playstation of the booking item must be filled in.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // perhitungan untuk biaya
        $Durasi = intval($this->request->getVar('Durasi'));
        $JenisPS = intval($this->request->getVar('JenisPS'));
        $TotalBiaya = $this->inventarisModel->countBiaya($Durasi, $JenisPS);

        $data = [
            'MemberID' => $this->request->getVar('MemberID'),
            'PenjagaID' => $this->request->getVar('PenjagaID'),
            'Durasi' => $Durasi,
            'JenisPS' => $JenisPS,
            'TanggalPemesanan' => date('Y-m-d'),
            'TotalBiaya' => $TotalBiaya
        ];
        $this->bookingModel->save($data);

        // flash data
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/booking');
    }


    // remove
    public function delete($id)
    {
        $this->bookingModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/booking');
    }
}
