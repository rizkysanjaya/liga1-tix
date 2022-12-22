<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use App\Models\Team;
use App\Models\Stadion;
use App\Models\Pertandingan;
use App\Models\Getkode;
use App\Models\Tiket;
use App\Models\Order;
use App\Models\Konfirm;


class Admin extends BaseController
{
    protected $user;
    protected $pertandingan;
    protected $team;
    protected $stadion;
    protected $getkode;
    protected $tiket;
    protected $order;
    protected $konfirm;


    /*
 * --------------------------------------------------------------------
 * Constructor
 * --------------------------------------------------------------------
 */
    function __construct()
    {
        $this->user = new User();
        $this->pertandingan = new Pertandingan();
        $this->team = new Team();
        $this->stadion = new Stadion();
        helper('tglindo_helper');
        $this->tiket = new Tiket();
        $this->konfirm = new Konfirm();
        $this->order = new Order();

        date_default_timezone_set("Asia/Jakarta");
    }

    /*
 * --------------------------------------------------------------------
 * Dashboard
 * --------------------------------------------------------------------
 */
    public function index()
    {
        return view('admin/dashboard');
    }


    /*
 * --------------------------------------------------------------------
 * Profile
 * --------------------------------------------------------------------
 */
    //profile
    public function profile()
    {
        $this->user = new User();


        // $data['user'] = $this->user->find($id);
        return view('admin/profile');
    }

    public function update_profile($id)
    {

        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid',


                ]
            ],
            'username' => [
                'rules' => 'max_length[12]|required',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'max_length' => 'Username terlalu panjang (maksimal 12 karakter)'
                ],
            ],
            'fullname' => [
                'rules' => 'max_length[30]',
                'errors' => [
                    'max_length' => 'Nama terlalu panjang (maksimal 30 karakter)'
                ],
            ],
            'bio' => [
                'rules' => 'max_length[500]',
                'errors' => [
                    'max_length' => 'Bio terlalu panjang (maksimal 500 karakter)'
                ]
            ],
            'user_image' => [
                'rules' => 'max_dims[user_image,800,800]|mime_in[user_image,image/jpg,image/jpeg,image/png]|max_size[user_image,4096]',
                'errors' => [

                    'mime_in' => 'File yang diupload bukan gambar',
                    'max_size' => 'Ukuran gambar terlalu besar, maksimal 4MB',
                    'max_dims' => 'Dimensi gambar terlalu besar, maksimal 800x800'
                ]
            ],

        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to('admin/profile')->withInput();
        }
        $file = $this->request->getFile('user_image');
        $userItem = $this->user->find($id);
        $oldImage = $userItem->user_image;


        if ($file->isValid() && !$file->hasMoved()) {
            if (file_exists('assets/img/user_profile/' . $oldImage)) {
                if ($oldImage != 'undraw_profile.svg') {
                    unlink('assets/img/user_profile/' . $oldImage);
                }

                $imageName = $file->getRandomName();
                $file->move('assets/img/user_profile/', $imageName);


                if ($userItem->email == $this->request->getVar('email')) {
                    //check username if same with old username, if yes then don't update username
                    if ($userItem->username == $this->request->getVar('username')) {
                        $data = [

                            'fullname' => trim($this->request->getVar('fullname')),
                            'bio' => trim($this->request->getVar('bio')),
                            'user_image' => $imageName,
                        ];
                    } else {
                        $data = [

                            'fullname' => trim($this->request->getVar('fullname')),
                            'bio' => trim($this->request->getVar('bio')),
                            'user_image' => $imageName,
                        ];
                    }
                } else {

                    if ($userItem->username == $this->request->getVar('username')) {
                        $data = [
                            'email' => trim($this->request->getVar('email')),
                            'fullname' => trim($this->request->getVar('fullname')),
                            'bio' => trim($this->request->getVar('bio')),
                            'user_image' => $imageName,

                        ];
                    } else {
                        $data = [
                            'email' => trim($this->request->getVar('email')),
                            'username' => trim($this->request->getVar('username')),
                            'fullname' => trim($this->request->getVar('fullname')),
                            'bio' => trim($this->request->getVar('bio')),
                            'user_image' => $imageName,
                        ];
                    }
                }
            }
        } else {
            if ($userItem->email == $this->request->getVar('email')) {
                //check username if same with old username, if yes then don't update username
                if ($userItem->username == $this->request->getVar('username')) {
                    $data = [

                        'fullname' => trim($this->request->getVar('fullname')),
                        'bio' => trim($this->request->getVar('bio')),
                    ];
                } else {
                    $data = [
                        'username' => trim($this->request->getVar('username')),
                        'fullname' => trim($this->request->getVar('fullname')),
                        'bio' => trim($this->request->getVar('bio')),
                    ];
                }
            } else {

                if ($userItem->username == $this->request->getVar('username')) {
                    $data = [
                        'email' => trim($this->request->getVar('email')),
                        'fullname' => trim($this->request->getVar('fullname')),
                        'bio' => trim($this->request->getVar('bio')),
                    ];
                } else {
                    $data = [
                        'email' => trim($this->request->getVar('email')),
                        'username' => trim($this->request->getVar('username')),
                        'fullname' => trim($this->request->getVar('fullname')),
                        'bio' => trim($this->request->getVar('bio')),
                    ];
                }
            }
        }
        $this->user->update($id, $data);

        session()->setFlashdata('message', 'Update Data Berhasil');
        return redirect()->to('admin/profile');
    }




    /*
 * --------------------------------------------------------------------
 * Team
 * --------------------------------------------------------------------
 */
    public function teamlist()
    {
        $data['teams'] = $this->team->findAll();

        return view('admin/data/team', $data);
    }

    public function addteam()
    {
        helper(['form']);
        return view('admin/data/create/add-team');
    }

    public function saveteam()
    {

        $getKode = model(Getkode::class);

        if (!$this->validate([
            'deskripsi' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Deskripsi harus diisi',
                    'min_length' => 'Deskripsi terlalu pendek',
                    'max_length' => 'Deskripsi terlalu panjang'
                ]
            ],
            'logo' => [
                'rules' => 'uploaded[logo]|max_dims[logo,256,256]|mime_in[logo,image/jpg,image/jpeg,image/png]|max_size[logo,4096]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'mime_in' => 'File yang diupload bukan gambar',
                    'max_size' => 'Ukuran gambar terlalu besar, maksimal 4MB',
                    'max_dims' => 'Dimensi gambar terlalu besar, maksimal 256x256'
                ]
            ],
            'kota' => [
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Kota harus diisi',
                    'min_length' => 'Kota terlalu pendek',
                    'max_length' => 'Kota terlalu panjang'
                ]
            ],
            'nama_team' => [
                'rules' => 'required|min_length[3]|max_length[100]|alpha_numeric_space',
                'errors' => [
                    'required' => 'Nama Team harus diisi',
                    'min_length' => 'Nama Team terlalu pendek',
                    'max_length' => 'Nama Team terlalu panjang',
                    'alpha_numeric_space' => 'Nama Team hanya boleh berisi huruf, angka, dan spasi'
                ]
            ]

        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $file = $this->request->getFile('logo');

        if ($file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move('assets/img/team_logo', $imageName);
        }
        $data = [
            'kd_team' => $getKode->get_kdteam(),
            'nama_team' => trim($this->request->getVar('nama_team')),
            'deskripsi' => trim($this->request->getVar('deskripsi')),
            'logo' => $imageName,
            'kota' => trim($this->request->getVar('kota')),
        ];
        $this->team->insert($data);

        session()->setFlashdata('message', 'Tambah Data Team Berhasil');
        return redirect()->to('/admin/data/team');
    }

    public function edit_team($id)
    {
        $data['team'] = $this->team->find($id);
        return view('admin/data/edit/edit-team', $data);
    }

    public function update_team($id)
    {
        helper(['form', 'url']);


        if (!$this->validate([
            'deskripsi' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Deskripsi harus diisi',
                    'min_length' => 'Deskripsi terlalu pendek',
                    'max_length' => 'Deskripsi terlalu panjang'
                ]
            ],
            'logo' => [
                'rules' => 'max_dims[logo,256,256]|mime_in[logo,image/jpg,image/jpeg,image/png]|max_size[logo,4096]',
                'errors' => [
                    // 'uploaded' => 'Pilih gambar terlebih dahulu',
                    'mime_in' => 'File yang diupload bukan gambar',
                    'max_size' => 'Ukuran gambar terlalu besar, maksimal 4MB',
                    'max_dims' => 'Dimensi gambar terlalu besar, maksimal 256x256'
                ]
            ],
            'kota' => [
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Kota harus diisi',
                    'min_length' => 'Kota terlalu pendek',
                    'max_length' => 'Kota terlalu panjang'
                ]
            ],
            'nama_team' => [
                'rules' => 'required|min_length[3]|max_length[100]|alpha_numeric_space',
                'errors' => [
                    'required' => 'Nama Team harus diisi',
                    'min_length' => 'Nama Team terlalu pendek',
                    'max_length' => 'Nama Team terlalu panjang',
                    'alpha_numeric_space' => 'Nama Team hanya boleh berisi huruf, angka, dan spasi'
                ]
            ]

        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $file = $this->request->getFile('logo');
        $teamItem = $this->team->find($id);
        $oldImage = $teamItem->logo;

        if ($file->isValid() && !$file->hasMoved()) {
            if (file_exists('assets/img/team_logo/' . $oldImage)) {
                unlink('assets/img/team_logo/' . $oldImage);
                $imageName = $file->getRandomName();
                $file->move('assets/img/team_logo/', $imageName);
                $data = [
                    'nama_team' => trim($this->request->getVar('nama_team')),
                    'deskripsi' => trim($this->request->getVar('deskripsi')),
                    'logo' => $imageName,
                    'kota' => trim($this->request->getVar('kota')),
                ];
            }
        } else {
            $data = [
                'nama_team' => trim($this->request->getVar('nama_team')),
                'deskripsi' => trim($this->request->getVar('deskripsi')),
                'kota' => trim($this->request->getVar('kota')),
            ];
        }


        $this->team->update($id, $data);
        session()->setFlashdata('message', 'Update Data Team Berhasil');
        return redirect()->to('/admin/data/team');
    }

    public function delete_team($id)
    {
        $teamItem = $this->team->find($id);
        $oldImage = $teamItem->logo;
        if (file_exists('assets/img/team_logo/' . $oldImage)) {
            unlink('assets/img/team_logo/' . $oldImage);
        }
        $this->team->delete($id);
        session()->setFlashdata('message', 'Hapus Data Team Berhasil');
        return redirect()->to('/admin/data/team');
    }




    /*
 * --------------------------------------------------------------------
 * Match
 * --------------------------------------------------------------------
 */
    public function matchlist()
    {


        $data['pertandingans'] = $this->pertandingan->findAll();
        return view('admin/data/match', $data);
    }

    public function addmatch()
    {
        $data['teams'] = $this->team->findAll();
        $data['stadions'] = $this->stadion->findAll();
        return view('admin/data/create/add-pertandingan', $data);
    }

    public function savepertandingan()
    {
        $getKode = model(Getkode::class);
        $this->team = new Team();

        if (!$this->validate([
            'kd_team1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Team 1 terlebih dahulu'
                ]
            ],
            'kd_team2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Team 2 terlebih dahulu'
                ]
            ],
            'tanggal' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Pilih Tanggal terlebih dahulu',
                    'valid_date' => 'Format tanggal salah, gunakan format mm/dd/yyyy'
                ]
            ],
            'waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Waktu terlebih dahulu'
                ]
            ],
            'banner_match' => [
                'rules' => 'uploaded[banner_match]|max_dims[banner_match,1920,1080]|mime_in[banner_match,image/jpg,image/jpeg,image/png]|max_size[banner_match,4096]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'mime_in' => 'File yang diupload bukan gambar',
                    'max_size' => 'Ukuran gambar terlalu besar, maksimal 4MB',
                    'max_dims' => 'Dimensi gambar terlalu besar, maksimal 1920x1080'
                ]
            ],
            'kd_stadion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Stadion terlebih dahulu'
                ]
            ],
            'harga_tb_timur' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga tribun timur harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ],
            'harga_tb_barat' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga tribun barat harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ],
            'harga_tb_vip' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga tribun vip harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ],
            'harga_tb_vvip' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga tribun vvip harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Status terlebih dahulu'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $file = $this->request->getFile('banner_match');

        if ($file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move('assets/img/banner', $imageName);
        }

        $kd_team1 = $this->request->getVar('kd_team1');
        $kd_team2 = $this->request->getVar('kd_team2');

        $team1Items = $this->team->where('kd_team', $kd_team1)->first();
        $team1Name = $team1Items->nama_team;
        $team1Logo = $team1Items->logo;

        $team2Items = $this->team->where('kd_team', $kd_team2)->first();
        $team2Name = $team2Items->nama_team;
        $team2logo = $team2Items->logo;

        $data = [
            'kd_pertandingan' => $getKode->get_kdpertandingan(),
            'kd_team1' => $kd_team1,
            'kd_team2' => $kd_team2,
            'nama_team1' => $team1Name,
            'nama_team2' => $team2Name,
            'logo_team1' => $team1Logo,
            'logo_team2' => $team2logo,
            'tanggal' => $this->request->getVar('tanggal'),
            'waktu' => $this->request->getVar('waktu'),
            'banner_image' => $imageName,
            'skor_team1' => 0,
            'skor_team2' => 0,
            'kd_stadion' => $this->request->getVar('kd_stadion'),
            'harga_tb_timur' => $this->request->getVar('harga_tb_timur'),
            'harga_tb_barat' => $this->request->getVar('harga_tb_barat'),
            'harga_tb_vip' => $this->request->getVar('harga_tb_vip'),
            'harga_tb_vvip' => $this->request->getVar('harga_tb_vvip'),
            'status' => $this->request->getVar('status'),
        ];

        $this->pertandingan->save($data);
        session()->setFlashdata('message', 'Tambah Data Pertandingan Berhasil');
        return redirect()->to('/admin/data/match');
    }

    public function edit_pertandingan($id)
    {

        $data['teams'] = $this->team->findAll();
        $data['stadions'] = $this->stadion->findAll();
        $data['pertandingan'] = $this->pertandingan->find($id);
        $data['team1'] = $this->team->where('kd_team', $data['pertandingan']->kd_team1)->first();
        $data['team2'] = $this->team->where('kd_team', $data['pertandingan']->kd_team2)->first();
        $data['stadion'] = $this->stadion->where('kd_stadion', $data['pertandingan']->kd_stadion)->first();

        return view('admin/data/edit/edit-pertandingan', $data);
    }

    public function update_pertandingan($id)
    {
        $getKode = model(Getkode::class);

        if (!$this->validate([
            'kd_team1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Team 1 terlebih dahulu'
                ]
            ],
            'kd_team2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Team 2 terlebih dahulu'
                ]
            ],
            'tanggal' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Pilih Tanggal terlebih dahulu',
                    'valid_date' => 'Format tanggal salah, gunakan format mm/dd/yyyy'
                ]
            ],
            'waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Waktu terlebih dahulu'
                ]
            ],
            'banner_match' => [
                'rules' => 'max_dims[banner_match,1920,1080]|mime_in[banner_match,image/jpg,image/jpeg,image/png]|max_size[banner_match,4096]',
                'errors' => [
                    'mime_in' => 'File yang diupload bukan gambar',
                    'max_size' => 'Ukuran gambar terlalu besar, maksimal 4MB',
                    'max_dims' => 'Dimensi gambar terlalu besar, maksimal 1920x1080'
                ]
            ],
            'kd_stadion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Stadion terlebih dahulu'
                ]
            ],
            'harga_tb_timur' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga tribun timur harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ],
            'harga_tb_barat' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga tribun barat harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ],
            'harga_tb_vip' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga tribun vip harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ],
            'harga_tb_vvip' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga tribun vvip harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Status terlebih dahulu'
                ]
            ],
            'skor_team1' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Skor Team 1 harus diisi',
                    'numeric' => 'Skor Team 1 harus berupa angka'
                ]
            ],
            'skor_team2' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Skor Team 2 harus diisi',
                    'numeric' => 'Skor Team 2 harus berupa angka'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $file = $this->request->getFile('banner_match');
        $matchItem = $this->pertandingan->find($id);
        $oldImage = $matchItem->banner_image;

        $kd_team1 = $this->request->getVar('kd_team1');
        $kd_team2 = $this->request->getVar('kd_team2');

        $team1Items = $this->team->where('kd_team', $kd_team1)->first();
        $team1Name = $team1Items->nama_team;
        $team1Logo = $team1Items->logo;

        $team2Items = $this->team->where('kd_team', $kd_team2)->first();
        $team2Name = $team2Items->nama_team;
        $team2logo = $team2Items->logo;

        if ($file->isValid() && !$file->hasMoved()) {
            if (file_exists('assets/img/banner/' . $oldImage)) {
                unlink('assets/img/banner/' . $oldImage);
                $imageName = $file->getRandomName();
                $file->move('assets/img/banner/', $imageName);
                $data = [
                    'kd_team1' => $this->request->getVar('kd_team1'),
                    'kd_team2' => $this->request->getVar('kd_team2'),
                    'nama_team1' => $team1Name,
                    'nama_team2' => $team2Name,
                    'logo_team1' => $team1Logo,
                    'logo_team2' => $team2logo,
                    'tanggal' => $this->request->getVar('tanggal'),
                    'waktu' => $this->request->getVar('waktu'),
                    'banner_image' => $imageName,
                    'kd_stadion' => $this->request->getVar('kd_stadion'),
                    'harga_tb_timur' => $this->request->getVar('harga_tb_timur'),
                    'harga_tb_barat' => $this->request->getVar('harga_tb_barat'),
                    'harga_tb_vip' => $this->request->getVar('harga_tb_vip'),
                    'harga_tb_vvip' => $this->request->getVar('harga_tb_vvip'),
                    'status' => $this->request->getVar('status'),
                    'skor_team1' => $this->request->getVar('skor_team1'),
                    'skor_team2' => $this->request->getVar('skor_team2'),

                ];
            }
        } else {
            $data = [
                'kd_team1' => $this->request->getVar('kd_team1'),
                'kd_team2' => $this->request->getVar('kd_team2'),
                'nama_team1' => $team1Name,
                'nama_team2' => $team2Name,
                'logo_team1' => $team1Logo,
                'logo_team2' => $team2logo,
                'tanggal' => $this->request->getVar('tanggal'),
                'waktu' => $this->request->getVar('waktu'),
                'kd_stadion' => $this->request->getVar('kd_stadion'),
                'harga_tb_timur' => $this->request->getVar('harga_tb_timur'),
                'harga_tb_barat' => $this->request->getVar('harga_tb_barat'),
                'harga_tb_vip' => $this->request->getVar('harga_tb_vip'),
                'harga_tb_vvip' => $this->request->getVar('harga_tb_vvip'),
                'status' => $this->request->getVar('status'),
                'skor_team1' => $this->request->getVar('skor_team1'),
                'skor_team2' => $this->request->getVar('skor_team2'),
            ];
        }


        $this->pertandingan->update($id, $data);
        session()->setFlashdata('message', 'Update Data Pertandingan Berhasil');
        return redirect()->to('/admin/data/match');
    }

    public function delete_match($id)
    {
        $matchItem = $this->pertandingan->find($id);
        $oldImage = $matchItem->banner_image;
        if (file_exists('assets/img/banner/' . $oldImage)) {
            unlink('assets/img/banner/' . $oldImage);
        }
        $this->pertandingan->delete($id);
        session()->setFlashdata('message', 'Hapus Data Pertandingan Berhasil');
        return redirect()->to('/admin/data/match');
    }

    /*
 * --------------------------------------------------------------------
 * Stadion
 * --------------------------------------------------------------------
 */
    public function stadionlist()
    {
        $data['stadions'] = $this->stadion->findAll();
        return view('admin/data/stadion', $data);
    }

    public function addstadion()
    {
        return view('admin/data/create/add-stadion');
    }

    public function savestadion()
    {
        helper(['form', 'url']);
        $getKode = model(Getkode::class);

        if (!$this->validate([
            'nama_stadion' => [
                'rules' => 'required|min_length[3]|max_length[100]|alpha_numeric_space',
                'errors' => [
                    'required' => 'Nama Stadion harus diisi',
                    'min_length' => 'Nama Stadion terlalu pendek',
                    'max_length' => 'Nama Stadion terlalu panjang',
                    'alpha_numeric_space' => 'Nama Stadion hanya boleh berisi huruf, angka, dan spasi'
                ]
            ],
            'kapasitas' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kapasitas harus diisi',
                    'numeric' => 'Kapasitas harus berupa angka'
                ]
            ],
            'alamat_stadion' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Alamat harus diisi',
                    'min_length' => 'Alamat terlalu pendek',
                    'max_length' => 'Alamat terlalu panjang'
                ]
            ]

        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $data = [
            'kd_stadion' => $getKode->get_kdstadion(),
            'nama_stadion' => trim($this->request->getVar('nama_stadion')),
            'kapasitas' => trim($this->request->getVar('kapasitas')),
            'alamat_stadion' => trim($this->request->getVar('alamat_stadion'))

        ];
        $this->stadion->save($data);
        session()->setFlashdata('message', 'Tambah Data Stadion Berhasil');
        return redirect()->to('/admin/data/stadion');
    }

    public function edit_stadion($id)
    {
        $data['stadion'] = $this->stadion->find($id);
        return view('admin/data/edit/edit-stadion', $data);
    }

    public function update_stadion($id)
    {
        helper(['form', 'url']);
        if (!$this->validate([
            'nama_stadion' => [
                'rules' => 'required|min_length[3]|max_length[100]|alpha_numeric_space',
                'errors' => [
                    'required' => 'Nama Stadion harus diisi',
                    'min_length' => 'Nama Stadion terlalu pendek',
                    'max_length' => 'Nama Stadion terlalu panjang',
                    'alpha_numeric_space' => 'Nama Stadion hanya boleh berisi huruf, angka, dan spasi'
                ]
            ],
            'kapasitas' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kapasitas harus diisi',
                    'numeric' => 'Kapasitas harus berupa angka'
                ]
            ],
            'alamat_stadion' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Alamat harus diisi',
                    'min_length' => 'Alamat terlalu pendek',
                    'max_length' => 'Alamat terlalu panjang'
                ]
            ]

        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $data = [
            'nama_stadion' => trim($this->request->getVar('nama_stadion')),
            'kapasitas' => trim($this->request->getVar('kapasitas')),
            'alamat_stadion' => trim($this->request->getVar('alamat_stadion'))

        ];
        $this->stadion->update($id, $data);
        session()->setFlashdata('message', 'Update Data Stadion Berhasil');
        return redirect()->to('/admin/data/stadion');
    }

    public function delete_stadion($id)
    {
        $this->stadion->delete($id);
        session()->setFlashdata('message', 'Hapus Data Stadion Berhasil');
        return redirect()->to('/admin/data/stadion');
    }

    /*
 * --------------------------------------------------------------------
 * Transaksi
 * --------------------------------------------------------------------
 */
    public function transaksilist()
    {
        return view('admin/data/transaksi');
    }


    /*
 * --------------------------------------------------------------------
 * Konfirmasi
 * --------------------------------------------------------------------
 */
    public function konfirmasilist()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM konfirm_order GROUP BY kd_order")->getResultArray();
        $data['title'] = 'Konfirm Order';
        $data['konfirmasi'] = $query;

        return view('admin/data/konfirmasi', $data);
    }

    public function detail_konfirmasi($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM konfirm_order WHERE kd_order = '$id'")->getResultArray();
        $data['title'] = 'Detail Konfirm Order';

        if ($query == NULL) {
            session()->setFlashdata('message', 'Tidak Ada Kiriman Konfirmasi');
            return redirect()->back();
        } else {
            $data['konfirmasi'] = $query;
            return view('admin/data/view-konfirm', $data);
        }
    }

    /*
 * --------------------------------------------------------------------
 * Tiket
 * --------------------------------------------------------------------
 */
    public function tiketlist()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM tiket GROUP BY kd_order")->getResultArray();
        $data['title'] = 'Tiket';
        $data['tiket'] = $query;

        return view('admin/data/tiket', $data);
    }

    public function detail_tiket($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT t.kd_order, t.kd_tiket, t.nama, t.harga, o.kd_pertandingan, o.jml_tiket, o.tgl_order FROM tiket as t INNER JOIN orders as o ON t.kd_order=o.kd_order INNER JOIN pertandingans as p ON o.kd_pertandingan=p.kd_pertandingan WHERE t.kd_order = '$id'")->getResultArray();
        $data['title'] = 'Detail Tiket';
        if ($query == NULL) {
            session()->setFlashdata('message', 'Tidak Ada Kiriman Konfirmasi');
            return redirect()->back();
        } else {
            $data['tiket'] = $query;
            return view('admin/data/view-tiket', $data);
        }
    }


    /*
 * --------------------------------------------------------------------
 * Order
 * --------------------------------------------------------------------
 */
    public function orderlist()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM orders GROUP BY kd_order")->getResultArray();
        $data['title'] = 'Order';
        $data['order'] = $query;

        return view('admin/data/order', $data);
    }

    public function view_order($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM orders WHERE kd_order = '$id'")->getResultArray();
        $data['title'] = 'Detail Order';
        if ($query == NULL) {
            session()->setFlashdata('message', 'Tidak Ada Order');
            return view('admin/data/view-order/', $id);
        } else {
            $data['tiket'] = $query;
            return view('admin/data/view-order', $data);
        }
    }

    public function inserttiket()
    {
        $kd_order = $this->request->getVar('kd_order');
        $kd_tiket = $this->request->getVar('kd_tiket');
        $email = $this->request->getVar('email');
        $jml_tiket = $this->request->getVar('jml_tiket');
        $status = $this->request->getVar('status');
        $total = $this->request->getVar('total');

        //update status pembayaran
        $this->order->set('status', $status)->where('kd_order', $kd_order)->update();

        //data untuk cetak tiket
        $db = \Config\Database::connect();

        $data['cetak'] = $db->query("SELECT o.qrcode, o.kd_order, o.tgl_order, o.harga_awal, o.email, o.tribun, k.kd_pertandingan, k.tanggal, s.nama_stadion, s.alamat_stadion, o.kd_tiket, o.jml_tiket, ko.nama, ko.jml_transfer FROM orders as o LEFT JOIN pertandingans as k ON o.kd_pertandingan=k.kd_pertandingan LEFT JOIN stadions as s ON k.kd_stadion=s.kd_stadion LEFT JOIN konfirm_order as ko ON o.kd_order=ko.kd_order WHERE o.kd_order= '$kd_order'")->getResultArray();

        //membuat tiket (pdf)
        $pdfFilePath = "assets/etiket/" . $kd_order . ".pdf";
        $html = view('user/cetaktiket', $data);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output($pdfFilePath, "F");


        //insert ke tabel tiket
        $save = [
            'kd_order' => $kd_order,
            'kd_tiket' => $kd_tiket,
            'nama' => $email,
            'harga' => $total,
            'etiket' => $kd_order . '.pdf',
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->tiket->insert($save);

        session()->setFlashdata('message', 'Tiket Order Berhasil Di Proses');
        return redirect()->to('/admin/data/order');
    }

    public function download($id)
    {
        return $this->response->download('assets/etiket/' . $id . '.pdf', null);
    }

    public function kirimemail($id = '')
    {

        $db = \Config\Database::connect();
        $this->order = new Order();

        $data['cetak'] = $db->query("SELECT o.qrcode, o.kd_order, o.tgl_order, o.harga_awal, o.email, o.tribun, k.kd_pertandingan, k.tanggal, s.nama_stadion, s.alamat_stadion, o.kd_tiket, o.jml_tiket, ko.nama, ko.jml_transfer FROM orders as o LEFT JOIN pertandingans as k ON o.kd_pertandingan=k.kd_pertandingan LEFT JOIN stadions as s ON k.kd_stadion=s.kd_stadion LEFT JOIN konfirm_order as ko ON o.kd_order=ko.kd_order WHERE o.kd_order= '$id'")->getResultArray();

        //email

        $attach  = base_url("assets/backend/upload/etiket/" . $id . ".pdf");

        $userItems = $this->order->where('kd_order', $id)->first();
        $userEmail = $userItems->email;
        //email
        $subject = 'E-ticket - Order ID ' . $id . ' - ' . date('dmY') . ' | Liga1-Tix';
        $message =  view('user/cetaktiket', $data);
        $to      = $userEmail;

        $email = \Config\Services::email();

        $email->setFrom('liga1tix@gmail.com', 'Liga1-Tix');
        $email->setTo($to);

        $email->setSubject($subject);
        $email->setMessage($message);
        // $email->attach($attach);

        if ($email->send()) {
            session()->setFlashdata('message', 'Email berhasil dikirim ke pelanggan');
            return redirect()->to('/admin/data/order');
        } else {
            session()->setFlashdata('error', 'Email gagal dikirim, hubungi Tim IT');
            return redirect()->to('/admin/data/order');
        }
    }
}
