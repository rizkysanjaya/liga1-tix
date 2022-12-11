<?php

namespace App\Controllers;
// use Myth\Auth\Controllers\AuthController;
use Dompdf\Dompdf;
use App\Models\Team;
use App\Models\Pertandingan;
use App\Models\Order;
use App\Models\Konfirm;
use App\Models\Stadion;
use App\Models\Tiket;

class Home extends BaseController
{

    protected $team;
    protected $pertandingan;
    protected $order;
    protected $konfirm;
    protected $stadion;
    protected $tiket;

    public function __construct()
    {
        helper('tglindo_helper');
        date_default_timezone_set("Asia/Jakarta");
    }


    public function landpage()
    {
        $this->team = new Team();
        $this->pertandingan = new Pertandingan();

        $data['team'] = $this->team->findAll();
        $data['pertandingan'] = $this->pertandingan->findAll();

        $data['live'] = $this->pertandingan->where('status', '1')->findAll();
        $data['upcoming'] = $this->pertandingan->where('status', '0')->findAll();
        $data['finish'] = $this->pertandingan->where('status', '2')->findAll();

        if (!empty($data['live'])) {
            session()->setFlashdata('live', 'Belum Ada Pertandingan');
            return view('/user/landpage', $data);
        }

        return view('/user/landpage', $data);
    }

    public function index()
    {


        if (in_groups('admin')) {
            return redirect()->to(base_url('/admin/dashboard'));
        } else {
            return $this->landpage();
        }
    }

    function countData($table)
    {
        $db = \Config\Database::connect();
        return $db->table($table)->countAllResults();
    }

    //pdf
    // public function pdf()
    // {
    //     $db = \Config\Database::connect();
    //     helper('tglindo_helper');
    //     $data['cetak'] = $db->query("SELECT o.qrcode, o.kd_order, o.tgl_order, o.harga_awal, o.email, o.tribun, k.kd_pertandingan, k.tanggal, s.nama_stadion, s.alamat_stadion, o.kd_tiket, o.jml_tiket, ko.nama, ko.jml_transfer FROM orders as o LEFT JOIN pertandingans as k ON o.kd_pertandingan=k.kd_pertandingan LEFT JOIN stadions as s ON k.kd_stadion=s.kd_stadion LEFT JOIN konfirm_order as ko ON o.kd_order=ko.kd_order WHERE o.kd_order= 'ORD0004'")->getResultArray();

    //     $mpdf = new \Mpdf\Mpdf();
    //     $pdfFilePath = "assets/etiket/" . 'ORDlohh' . ".pdf";
    //     $html = view('user/cetaktiket', $data);
    //     $mpdf->WriteHTML($html);
    //     $mpdf->Output($pdfFilePath, "F");
    //     // $dompdf = new Dompdf();
    //     // $dompdf->loadHtml($html);
    //     // (Optional) Setup the paper size and orientation
    //     // $dompdf->setPaper('A4', 'landscape');

    //     // // Render the HTML as PDF
    //     // $dompdf->render();

    //     // // Output the generated PDF to Browser
    //     // $dompdf->stream('/assets/etiket/etiket.pdf');

    //     // return view('user/cetaktiket', $data);
    // }
}
