<?php

namespace App\Controllers;

use App\Models\BookingModel;

class Booking extends BaseController
{

    protected $bookingModel;

    // construct untuk db
    public function __construct()
    {
        $this->bookingModel = new BookingModel();
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
            'validation' => \Config\Services::validation()
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
        $Durasi = $this->request->getVar('Durasi');
        $JenisPS = $this->request->getVar('JenisPS');
        $TotalBiaya = $this->bookingModel->countBiaya($Durasi, $JenisPS);

        $data = [
            'MemberID' => $this->request->getVar('MemberID'),
            'PenjagaID' => $this->request->getVar('PenjagaID'),
            'Durasi' => $Durasi,
            'JenisPS' => $JenisPS,
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
