<?php

namespace App\Controllers;

use App\Models\BookingModel;
use \Dompdf\Dompdf;

class Report extends BaseController
{
    protected $bookingModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
    }

    public function booking()
    {
        $dompdf = new Dompdf();
        $data = [
            'booking' => $this->bookingModel->getBooking()
        ];

        $html =  view('report/booking', $data);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('Booking Reports.pdf', ['Attachment' => 0]);
    }
}
