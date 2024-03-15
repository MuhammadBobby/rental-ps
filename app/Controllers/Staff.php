<?php

namespace App\Controllers;

use App\Models\StaffModel;

class Staff extends BaseController
{

    protected $staffModel;

    // construct untuk db
    public function __construct()
    {
        $this->staffModel = new StaffModel();
    }

    public function index(): string
    {
        $data = [
            'title' => "Dashboard | Staff Data",
            'staff' => $this->staffModel->getStaff()
        ];
        return view('pages/staff/index', $data);
    }

    // create
    public function create()
    {
        $data = [
            'title' => "Dashboard | Create Data",
            'validation' => \Config\Services::validation()
        ];
        return view('pages/staff/create', $data);
    }

    // save
    public function save()
    {
        // validation
        $rules = [
            'Nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Name of the staff item must be filled in.',
                ]
            ],
            'Shift' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Shift of the staff item must be filled in.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'Nama' => $this->request->getVar('Nama'),
            'Shift' => $this->request->getVar('Shift'),
        ];
        $this->staffModel->save($data);

        // flash data
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/staff');
    }

    // edit
    public function edit($id)
    {
        $data = [
            'title' => "Dashboard | Edit Data",
            'staff' => $this->staffModel->getStaff($id),
            'validation' => \Config\Services::validation()
        ];
        return view('pages/staff/edit', $data);
    }


    // update
    public function update($id)
    {
        // validation
        $rules = [
            'Nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Name of the staff item must be filled in.',
                ]
            ],
            'Shift' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Shift of the staff item must be filled in.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'PenjagaID' => $id,
            'Nama' => $this->request->getVar('Nama'),
            'Shift' => $this->request->getVar('Shift'),
        ];
        $this->staffModel->save($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/staff');
    }

    // remove
    public function delete($id)
    {
        $this->staffModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/staff');
    }
}
