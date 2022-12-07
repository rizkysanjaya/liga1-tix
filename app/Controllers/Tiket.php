<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pertandingan;
use App\Models\Getkode;
use App\Models\Bank;
use App\Models\Order;

require_once 'vendor/autoload.php';

use nguyenary\QRCodeMonkey\QRCode;


class Tiket extends BaseController
{
    protected $pertandingan;
    protected $tiket;
    protected $bank;
    protected $order;


    function __construct()
    {
        $this->load->helper('tglindo_helper');
        $this->pertandingan = new Pertandingan();
        $this->tiket = new Tiket();
        $this->bank = new Bank();
        $this->order = new Order();

        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $data['title'] = "Match List";
        $data['pertandingan'] = $this->pertandingan->where('status', '0')->findAll();
        $this->load->view('user/matchlist', $data);
    }

    public function before_order($kd_pertandingan)
    {
        $data['title'] = "View Order";
        $data['pertandingan'] = $this->pertandingan->where('kd_pertandingan', $kd_pertandingan)->first();
        // $data['tribun'] = $this->request->getVar('tribun');
        $this->load->view('user/before_order', $data);
    }

    public function order($kd_pertandingan)
    {


        $data['title'] = "Order Tiket";
        $data['pertandingan'] = $this->pertandingan->where(['kd_pertandingan' => $kd_pertandingan])->first();
        $data['bank'] = $this->bank->findAll();


        $this->load->view('user/order', $data);
    }

    // public function gettiket($value = '')
    // {

    //     $getKode = model(Getkode::class);
    //     // $satu_hari        = mktime(0,0,0,date("n"),date("j")+1,date("Y"));
    // 	// $expired       = date("d-m-Y", $satu_hari)." ".date('H:i:s');
    //     $jambeli = date("Y-m-d H:i:s"); 
    //     $tanggal = hari_indo(date('N',strtotime($jambeli))).', '.tanggal_indo(date('Y-m-d',strtotime(''.$jambeli.''))).', '.date('H:i',strtotime($jambeli));


    //     if(!$this->validate([
    //         'tribun' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Tribun harus diisi'
    //             ]
    //         ],
    //         'jml_tiket' => [
    //             'rules' => 'required|',
    //             'errors' => [
    //                 'required' => 'Jumlah tiket harus diisi'
    //             ]
    //         ],
    //         'no_tlp' => [
    //             'rules' => 'required|numeric|max_length[13]|min_length[10]',
    //             'errors' => [
    //                 'required' => 'No. Telepon harus diisi',
    //                 'numeric' => 'No. Telepon harus angka',
    //                 'max_length' => 'No. Telepon maksimal 13 angka',
    //                 'min_length' => 'No. Telepon minimal 10 angka'
    //             ]
    //         ],
    //         'email' => [
    //             'rules' => 'required|valid_email',
    //             'errors' => [
    //                 'required' => 'Email harus diisi',
    //                 'valid_email' => 'Email tidak valid'
    //             ]
    //         ],
    //         'bank' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Bank harus diisi'
    //             ]
    //         ],


    //     ])){
    //         session()->setFlashdata('error', $this->validator->listErrors());
    //         return redirect()->back()->withInput();
    //     }
    //     $kode = $getKode->get_kdorder();
    //     $qrcode = new QRCode($kode);
    //     $qrcode->setConfig([
    //         'bgColor' => '#FFFFFF',
    //         'body' => 'square',
    //         'bodyColor' => '#0277bd',
    //         'brf1' => [],
    //         'brf2' => [],
    //         'brf3' => [],
    //         'erf1' => [],
    //         'erf2' => [],
    //         'erf3' => [],
    //         'eye' => 'frame0',
    //         'eye1Color' => '#000000',
    //         'eye2Color' => '#000000',
    //         'eye3Color' => '#000000',
    //         'eyeBall' => 'ball0',
    //         'eyeBall1Color' => '#000000',
    //         'eyeBall2Color' => '#000000',
    //         'eyeBall3Color' => '#000000',
    //         'gradientColor1' => '#000000',
    //         'gradientColor2' => '#000000',
    //         'gradientOnEyes' => 'true',
    //         'gradientType' => 'linear',
    //     ]);

    //     $qrcode->setLogo('assets/img/logo-ct.png');
    //     $qrcode->setFileType('png');
    //     $qrcode->setSize(256);
    //     $qrcode->create(''.$kode.'');
    //     $tribun = $this->request->getVar('tribun');
    //     if($tribun == 'VIP'){
    //         $harga_tribun = $this->pertandingan->findColumn('harga_tb_vip')->where('kd_pertandingan', $kd_pertandingan)->first();
    //     }elseif($tribun == 'VVIP'){
    //         $harga_tribun = $this->pertandingan->findColumn('harga_tb_vvip')->where('kd_pertandingan', $kd_pertandingan)->first();
    //     }elseif($tribun == 'Barat'){
    //         $harga_tribun = $this->pertandingan->findColumn('harga_tb_barat')->where('kd_pertandingan', $kd_pertandingan)->first();
    //     }elseif($tribun == 'Timur'){
    //         $harga_tribun = $this->pertandingan->findColumn('harga_tb_timur')->where('kd_pertandingan', $kd_pertandingan)->first();
    //     }

    //     $data = [
    //         'kd_order' => $kode,
    //         'kd_tiket' => $getKode->get_kdtiket(),
    //         'id_user' => $this->request->getVar('id_user'),
    //         'kd_pertandingan' => $this->request->getVar('kd_pertandingan'),
    //         'kd_bank' => $this->request->getVar('bank'),
    //         'tgl_order' => $tanggal,
    //         'tribun' => $this->request->getVar('tribun'),
    //         'jml_tiket' => $this->request->getVar('jml_tiket'),
    //         'no_tlp' => $this->request->getVar('no_tlp'),
    //         'email' => $this->request->getVar('email'),
    //         'expired' => date("Y-m-d H:i:s", strtotime('+1 day')),
    //         'status' => '1',
    //         'qrcode' => $qrcode,

    //     ];

    //     $this->order->insert($data);
    //     $this->session->set_flashdata('message', 'Tiket berhasil di pesan');
    //     return redirect()->to(base_url('user/checkout'. $getKode));

    // }

    // public function payment($id = '')
    // {

    //     $sqlcek = $this->db->query("SELECT * FROM orders LEFT JOIN users on orders.id_user = users.id LEFT JOIN pertandingans on orders.kd_pertandingan = pertandingans.kd_pertandingan LEFT JOIN bank on orders.kd_bank = bank.kd_bank WHERE kd_order ='$id'")->result_array();
    //     // $data['count'] = count($sqlcek);
    //     $data['tiket'] = $sqlcek;
    //     $this->load->view('user/payment', $data);
    // }
    // public function checkout($value = '')
    // {

    //     $data['tiket'] = $value;
    //     $send['sendmail'] = $this->db->query("SELECT * FROM tbl_order LEFT JOIN tbl_jadwal on tbl_order.kd_jadwal = tbl_jadwal.kd_jadwal LEFT JOIN tbl_tujuan on tbl_jadwal.kd_tujuan = tbl_tujuan.kd_tujuan LEFT JOIN tbl_bank on tbl_order.kd_bank = tbl_bank.kd_bank WHERE kd_order ='$value'")->row_array();
    //     $send['count'] = count($send['sendmail']);
    //     //email
    //     $subject = 'XTRANS';
    //     $message = $this->load->view('user/sendmail', $send, TRUE);
    //     $to      = $this->session->userdata('email');
    //     $config = [
    //         'mailtype'  => 'html',
    //         'charset'   => 'utf-8',
    //         'protocol'  => 'smtp',
    //         'smtp_host' => 'smtp.googlemail.com',
    //         'smtp_user' => 'liga1tix@gmail.com', // Ganti dengan email gmail kamu
    //         'smtp_pass' => 'ltyvtfmfkpulohmm',    // Password gmail kamu
    //         'smtp_port' => '465',
    //         'crlf'      => "rn",
    //         'newline'   => "rn"
    //     ];
    //     $this->load->library('email', $config);
    //     $this->email->set_newline("\r\n");
    //     $this->email->from('XTRANS');
    //     $this->email->to($to);
    //     $this->email->subject($subject);
    //     $this->email->message($message);
    //     if ($this->email->send()) {
    //         $this->session->set_flashdata('message', 'swal("Cek", "Email kamu untuk melakukan pembayaran", "success");');
    //         $this->load->view('user/checkout', $data);
    //     } else {
    //         echo 'Error! Kirim email error';
    //     }
    // }

    // public function konfirmasi($value = '', $harga = '')
    // {

    //     $data['id'] = $value;
    //     $data['total'] = $harga;
    //     $this->load->view('user/konfirmasi', $data);
    // }
    // public function insertkonfirmasi($value = '')
    // {

    //     $config['upload_path'] = './assets/img/payment';
    //     $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //     $this->load->library('upload', $config);
    //     if (!$this->upload->do_upload('userfile')) {
    //         $error = array('error' => $this->upload->display_errors());
    //         $this->session->set_flashdata('message', 'swal("Gagal", "Cek Kembali Konfirmasi Anda", "error");');
    //         redirect('tiket/konfirmasi/' . $this->input->post('kd_order') . '/' . $this->input->post('total'));
    //     } else {
    //         $upload_data = $this->upload->data();
    //         $featured_image = '/assets/user/upload/payment/' . $upload_data['file_name'];
    //         $data = array(
    //             'kd_konfirmasi' => $this->getkod_model->get_kodkon(),
    //             'kd_order'    => $this->input->post('kd_order'),
    //             'nama_bank_konfirmasi'        => $this->input->post('bank_km'),
    //             'nama_konfirmasi' =>  $this->input->post('nama'),
    //             'norek_konfirmasi'        => $this->input->post('nomrek'),
    //             'total_konfirmasi' => $this->input->post('total'),
    //             'photo_konfirmasi' => $featured_image
    //         );
    //         $this->db->insert('tbl_konfirmasi', $data);
    //         $this->session->set_flashdata('message', 'swal("Berhasil", "Terima Kasih Atas Konfirmasinya", "success");');
    //         redirect('profile/tiketsaya/' . $this->session->userdata('kd_pelanggan'));
    //     }
    // }
    // public function cetak($id = '')
    // {

    //     $order = $id;
    //     $data['cetak'] = $this->db->query("SELECT * FROM tbl_order LEFT JOIN tbl_bus on tbl_order.kd_bus = tbl_bus.kd_bus LEFT JOIN tbl_jadwal on tbl_order.kd_jadwal = tbl_jadwal.kd_jadwal LEFT JOIN tbl_tujuan on tbl_jadwal.kd_tujuan = tbl_tujuan.kd_tujuan WHERE kd_order ='" . $id . "'")->result_array();
    //     $tiket = $this->db->query("SELECT email_pelanggan FROM tbl_pelanggan WHERE kd_pelanggan ='" . $data['cetak'][0]['kd_pelanggan'] . "'")->row_array();
    //     die(print_r($tiket));
    // }
}
