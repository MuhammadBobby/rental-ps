<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => "Dashboard Admin",
        ];

        return view('pages/dashboard', $data);
    }
}
