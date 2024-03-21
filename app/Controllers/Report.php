<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\InventarisModel;
use App\Models\MemberModel;
use App\Models\StaffModel;
use \Dompdf\Dompdf;

class Report extends BaseController
{
    protected $bookingModel;
    protected $inventarisModel;
    protected $memberModel;
    protected $staffModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->inventarisModel = new InventarisModel();
        $this->memberModel = new MemberModel();
        $this->staffModel = new StaffModel();
    }

    public function booking()
    {
        $dompdf = new Dompdf();
        $data = [
            'title' => 'Booking Reports',
            'booking' => $this->bookingModel->getBooking()
        ];

        $html =  view('report/booking', $data);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('Booking Reports.pdf', ['Attachment' => 0]);
    }

    public function inventaris()
    {
        $dompdf = new Dompdf();
        $data = [
            'title' => 'Inventaris Reports',
            'inventaris' => $this->inventarisModel->getInventaris()
        ];

        $html =  view('report/inventaris', $data);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('Inventaris Reports.pdf', ['Attachment' => 0]);
    }

    public function member()
    {
        $dompdf = new Dompdf();
        $data = [
            'title' => 'Member Reports',
            'members' => $this->memberModel->getMember()
        ];

        $html =  view('report/member', $data);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('Member Reports.pdf', ['Attachment' => 0]);
    }

    public function staff()
    {
        $dompdf = new Dompdf();
        $data = [
            'title' => 'Staff Reports',
            'staffs' => $this->staffModel->getStaff()
        ];

        $html =  view('report/staff', $data);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('Staff Reports.pdf', ['Attachment' => 0]);
    }
}
