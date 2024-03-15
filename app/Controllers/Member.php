<?php

namespace App\Controllers;

use App\Models\MemberModel;

class Member extends BaseController
{

    protected $memberModel;

    // construct untuk db
    public function __construct()
    {
        $this->memberModel = new MemberModel();
    }

    public function index(): string
    {
        $data = [
            'title' => "Dashboard | Member Data",
            'member' => $this->memberModel->getMember()
        ];

        return view('pages/member/index', $data);
    }
}
