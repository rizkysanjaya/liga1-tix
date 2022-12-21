<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pertandingan;
use App\Models\Getkode;
use App\Models\Bank;
use App\Models\Order;
use App\Models\Stadion;
use App\Models\Team;
use App\Models\User;
use App\Models\Konfirm;
use nguyenary\QRCodeMonkey\QRCode;


class Tiket extends BaseController
{
    protected $pertandingan;
    protected $tiket;
    protected $bank;
    protected $order;
    protected $stadion;
    protected $team;
    protected $konfirmasi;


    function __construct()
    {

        helper('tglindo_helper');

        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $this->pertandingan = new Pertandingan();

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data['pertandingans'] = $this->pertandingan->search($keyword);
            session()->setFlashdata('info', 'Hasil pencarian untuk keyword "' . $keyword . '" tidak ditemukan!');
        } else {
            $data['pertandingans'] = $this->pertandingan->where('status', '0')->findAll();
        }

        $data['title'] = "Match List";

        return view('user/matchlist', $data);
    }




    public function before_order($id)
    {
        $this->pertandingan = new Pertandingan();
        $this->stadion = new Stadion();
        $this->team = new Team();


        $data['title'] = "View Order";
        $data['pertandingan'] = $this->pertandingan->find($id);
        $data['team1'] = $this->team->where('kd_team', $data['pertandingan']->kd_team1)->first();
        $data['team2'] = $this->team->where('kd_team', $data['pertandingan']->kd_team2)->first();
        $data['stadion'] = $this->stadion->where('kd_stadion', $data['pertandingan']->kd_stadion)->first();
        return view('user/before-order', $data);
    }

    //fungsi untuk menampilkan halaman order
    public function order()
    {

        if (!$this->validate([
            'tribun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tribun harus dipilih'
                ]
            ],
            'jml_tiket' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah tiket harus diisi'
                ]
            ]
        ])) {
            $data['title'] = "View Order";
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->pertandingan = new Pertandingan();
        $this->bank = new Bank();
        $this->team = new Team();
        $this->stadion = new Stadion();
        $this->order = new Order();

        $kdpert = $this->request->getPost('kd_pertandingan');
        $tribun = $this->request->getPost('tribun');
        $jmltiket = $this->request->getPost('jml_tiket');
        if ($tribun == 'timur') {
            $harga = $this->pertandingan->where('kd_pertandingan', $kdpert)->first()->harga_tb_timur;
        } elseif ($tribun == 'barat') {
            $harga = $this->pertandingan->where('kd_pertandingan', $kdpert)->first()->harga_tb_barat;
        } elseif ($tribun == 'vip') {
            $harga = $this->pertandingan->where('kd_pertandingan', $kdpert)->first()->harga_tb_vip;
        } elseif ($tribun == 'vvip') {
            $harga = $this->pertandingan->where('kd_pertandingan', $kdpert)->first()->harga_tb_vvip;
        }
        $data['title'] = "Order Tiket";
        $data['pertandingan'] = $this->pertandingan->where('kd_pertandingan', $kdpert)->first();
        $data['team1'] = $this->team->where('kd_team', $data['pertandingan']->kd_team1)->first();
        $data['team2'] = $this->team->where('kd_team', $data['pertandingan']->kd_team2)->first();
        $data['stadion'] = $this->stadion->where('kd_stadion', $data['pertandingan']->kd_stadion)->first();
        $data['bank'] = $this->bank->findAll();
        $data['total'] = $harga * $jmltiket;
        $data['tribun'] = $tribun;
        $data['tiket'] = $jmltiket;
        $data['harga'] = $harga;

        return view('user/order', $data);
    }


    public function gettiket()
    {
        //ini validasi yang menyebabkan bug redirect error
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'no_tlp' => [
                'rules' => 'required|numeric|min_length[10]|max_length[13]',
                'errors' => [
                    'required' => 'No. Telepon harus diisi',
                    'numeric' => 'No. Telepon harus angka',
                    'min_length' => 'No. Telepon minimal 10 angka',
                    'max_length' => 'No. Telepon maksimal 13 angka'
                ]
            ]
        ])) {
            $data['title'] = "Order Tiket";
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to('user');
        }

        $getKode = model(Getkode::class);
        $this->order = new Order();

        $jambeli = date("Y-m-d H:i:s");
        $tanggal = hari_indo(date('N', strtotime($jambeli))) . ', ' . tanggal_indo(date('Y-m-d', strtotime('' . $jambeli . ''))) . ', ' . date('H:i', strtotime($jambeli));
        $kd_order = $getKode->get_kdorder();
        $kd_pertandingan = $this->request->getPost('kd_pertandingan');
        $kd_stadion = $this->request->getPost('kd_stadion');
        $tribun = $this->request->getPost('tribun');
        $jml_tiket = $this->request->getPost('jml_tiket');
        $total = $this->request->getPost('total');
        $kd_bank = $this->request->getPost('bank');
        $email = $this->request->getPost('email');
        $no_tlp = $this->request->getPost('no_tlp');
        $harga = $this->request->getPost('harga');

        $qrcode = new QRCode($kd_order);
        $qrcode->setConfig([
            'bgColor' => '#FFFFFF',
            'body' => 'round',
            'bodyColor' => '#ea3c33',
            'brf1' => [],
            'brf2' => [],
            'brf3' => [],
            'erf1' => [],
            'erf2' => [],
            'erf3' => [],
            'eye' => 'frame11',
            'eye1Color' => '#ea3c33',
            'eye2Color' => '#ea3c33',
            'eye3Color' => '#ea3c33',
            'eyeBall' => 'ball2',
            'eyeBall1Color' => '#ea3c33',
            'eyeBall2Color' => '#ea3c33',
            'eyeBall3Color' => '#ea3c33',
            'gradientColor1' => '',
            'gradientColor2' => '',
            'gradientOnEyes' => 'true',
            'gradientType' => 'linear',
        ]);

        $qrcode->setLogo('assets/img/logo-ct.png');
        $qrcode->setFileType('png');
        $qrcode->setSize(300);
        $qrcode->create('assets/img/qrcode/' . $kd_order . '.png');


        $data = [
            'kd_order' => $kd_order,
            'kd_tiket' => 'TK-' . $kd_order . substr($kd_pertandingan, 3) . substr($kd_stadion, 3),
            'id_user' => $this->request->getPost('id_user'),
            'kd_pertandingan' => $kd_pertandingan,
            'kd_stadion' => $kd_stadion,
            'kd_bank' => $kd_bank,
            'email' => trim($email),
            'no_tlp' => trim($no_tlp),
            'harga_awal' => $harga,
            'jml_tiket' => $jml_tiket,
            'tgl_order' => $tanggal,
            'tribun' => $tribun,
            'expired' => date("Y-m-d H:i:s", strtotime('+1 day')),
            'status' => '1',
            'qrcode' => $kd_order . '.png',

        ];

        $this->order->insert($data);
        session()->setFlashdata('message', 'Tiket berhasil di pesan');
        return redirect()->to(base_url('user/checkout/' . $kd_order));
    }


    public function checkout($value = '')
    {

        $db = \Config\Database::connect();
        $this->user = new User();
        $this->order = new Order();


        $data['tiket'] = $value;
        $data['title'] = 'Checkout';
        $query = $db->query("SELECT * FROM orders LEFT JOIN users on orders.id_user = users.id LEFT JOIN pertandingans on orders.kd_pertandingan = pertandingans.kd_pertandingan LEFT JOIN bank on orders.kd_bank = bank.kd_bank LEFT JOIN stadions on orders.kd_stadion = stadions.kd_stadion WHERE kd_order = '$value'");

        $send['sendmail'] = $query->getRowObject();

        $userItems = $this->order->where('kd_order', $send['sendmail']->kd_order)->first();
        $userEmail = $userItems->email;
        //email
        $subject = 'Selesaikan Pembayaran | Liga1-Tix';
        $message = view('pages/layouts/sendmail', $send);
        $to      = $userEmail;

        $email = \Config\Services::email();

        $email->setFrom('liga1tix@gmail.com', 'Liga1-Tix');
        $email->setTo($to);

        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            session()->setFlashdata('message', 'Cek Email kamu untuk melakukan pembayaran');
            return view('user/checkout', $data);
        } else {
            session()->setFlashdata('message', 'Email gagal dikirim, hubungi admin');
            return view('user/checkout', $data);
        }
    }

    public function payment($id = '')
    {
        $db = \Config\Database::connect();
        $data['title'] = 'Checkout';
        $query = $db->query("SELECT * FROM orders LEFT JOIN users on orders.id_user = users.id INNER JOIN pertandingans on orders.kd_pertandingan = pertandingans.kd_pertandingan LEFT JOIN bank on orders.kd_bank = bank.kd_bank LEFT JOIN stadions on orders.kd_stadion = stadions.kd_stadion WHERE kd_order = '$id'");

        $data['tiket'] = $query->getRowObject();
        return view('user/payment', $data);
    }

    public function konfirmasi($value = '', $harga = '')
    {

        $data['id'] = $value;
        $data['total'] = $harga;
        $data['title'] = 'Konfirmasi Pembayaran';
        return view('user/konfirmasi', $data);
    }

    public function insertkonfirmasi($value = '')
    {

        $this->konfirmasi = new Konfirm();
        $getKode = model(Getkode::class);


        if (!$this->validate([
            'userfile' => [
                'rules' => 'uploaded[userfile]|mime_in[userfile,image/jpg,image/jpeg,image/png]|max_size[userfile,4096]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'mime_in' => 'File yang diupload bukan gambar',
                    'max_size' => 'Ukuran gambar terlalu besar, maksimal 4MB'

                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[3]|max_length[100]|alpha_numeric_space',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'min_length' => 'Nama terlalu pendek',
                    'max_length' => 'Nama terlalu panjang',
                    'alpha_numeric_space' => 'Nama hanya boleh berisi huruf, angka, dan spasi'
                ]
            ],
            'bank_km' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bank tidak boleh kosong'
                ]
            ],
            'nomrek' => [
                'rules' => 'required|min_length[13]|max_length[16]|numeric',
                'errors' => [
                    'required' => 'No Rekening tidak boleh kosong',
                    'min_length' => 'No Rekening terlalu pendek, mohon masukan no rekening yang benar',
                    'max_length' => 'No Rekening terlalu panjang, mohon masukan no rekening yang benar',
                    'numeric' => 'No Rekening hanya boleh berisi angka'
                ]
            ]
        ])) {

            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to('user/konfirmasi/' . $this->request->getVar('kd_order') . '/' . $this->request->getVar('total'));
        }


        $file = $this->request->getFile('userfile');

        if ($file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move('assets/img/payment', $imageName);
        }
        $data = [
            'kd_konfirm' => $getKode->get_kdkonfirmasi(),
            'kd_order' => $this->request->getVar('kd_order'),
            'nama' => trim($this->request->getVar('nama')),
            'nama_bank' => trim($this->request->getVar('bank_km')),
            'no_rek' => trim($this->request->getVar('nomrek')),
            'jml_transfer' => trim($this->request->getVar('total')),
            'bukti_transfer' => $imageName,

        ];
        $this->konfirmasi->insert($data);

        $id = user()->id;

        session()->setFlashdata('message', 'Upload Bukti Pembayaran Berhasil, Silahkan Tunggu Konfirmasi Admin');
        return redirect()->to('/user/profile');
    }


    public function download($id)
    {
        return $this->response->download('assets/etiket/' . $id . '.pdf', null);
    }
}
