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
}
