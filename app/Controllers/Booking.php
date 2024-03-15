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
}
