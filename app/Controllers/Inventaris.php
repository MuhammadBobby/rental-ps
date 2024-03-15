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
}
