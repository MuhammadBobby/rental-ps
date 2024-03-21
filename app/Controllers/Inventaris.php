<?php

namespace App\Controllers;

use App\Models\InventarisModel;

class Inventaris extends BaseController
{

    protected $inventarisModel;

    // construct untuk db
    public function __construct()
    {
        $this->inventarisModel = new InventarisModel();
    }

    public function index(): string
    {
        $data = [
            'title' => "Dashboard | Inventaris Data",
            'invent' => $this->inventarisModel->getInventaris()
        ];
        return view('pages/inventaris/index', $data);
    }


    // create
    public function create()
    {
        $data = [
            'title' => "Dashboard | Create Data",
            'validation' => \Config\Services::validation()
        ];
        return view('pages/inventaris/create', $data);
    }

    // save
    public function save()
    {
        // validation
        $rules = [
            'NamaBarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Name of the Inventaris item must be filled in.',
                ]
            ],
            'Jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Type of the Inventaris item must be filled in.',
                ]
            ],
            'HargaPerJam' =>  [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'The Price of the Inventaris item must be filled in.',
                    'numeric' => 'The Price of the Inventaris item must be numeric.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'NamaBarang' => $this->request->getVar('NamaBarang'),
            'Jenis' => $this->request->getVar('Jenis'),
            'Status' => 'Tersedia',
            'HargaPerJam' => $this->request->getVar('HargaPerJam'),
        ];
        $this->inventarisModel->save($data);

        // flash data
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/inventaris');
    }

    // edit
    public function edit($id)
    {
        $data = [
            'title' => "Dashboard | Edit Data",
            'invent' => $this->inventarisModel->getInventaris($id),
            'validation' => \Config\Services::validation()
        ];
        return view('pages/inventaris/edit', $data);
    }


    // update
    public function update($id)
    {
        // validation
        $rules = [
            'NamaBarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Name of the Inventaris item must be filled in.',
                ]
            ],
            'Jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Type of the Inventaris item must be filled in.',
                ]
            ],
            'HargaPerJam' =>  [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'The Price of the Inventaris item must be filled in.',
                    'numeric' => 'The Price of the Inventaris item must be numeric.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'BarangID' => $id,
            'NamaBarang' => $this->request->getVar('NamaBarang'),
            'Jenis' => $this->request->getVar('Jenis'),
            'Status' => $this->request->getVar('Status'),
            'HargaPerJam' => $this->request->getVar('HargaPerJam'),
        ];
        $this->inventarisModel->save($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/inventaris');
    }

    // remove
    public function delete($id)
    {
        $this->inventarisModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/inventaris');
    }
}
