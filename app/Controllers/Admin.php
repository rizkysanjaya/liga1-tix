<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use App\Models\Team;
use App\Models\Stadion;
use App\Models\Pertandingan;
use App\Models\Getkode;
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
// use Myth\Auth\Entities\User;

class Admin extends BaseController
{
    protected $user;
    protected $pertandingan;
    protected $team;
    protected $stadion;
    protected $getkode;



    function __construct()
    {
        $this->user = new User();
        $this->pertandingan = new Pertandingan();
        $this->team = new Team();
        $this->stadion = new Stadion();
    }

    //dashboard
    public function index()
    {
        return view('admin/dashboard');
    }

    //profile
    public function profile()
    {

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
                'rules' => 'required|is_unique[users.username,id,{id}]',
                'errors' => [
                    'required' => 'Username harus diisi',
                ],
            ],
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi',
                ],
            ],
            'bio' => [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Bio terlalu panjang'
                ]
            ],
            'user_image' => [
                'rules' => 'uploaded[user_image]|max_dims[user_image,800,800]|mime_in[user_image,image/jpg,image/jpeg,image/png]|max_size[user_image,4096]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'mime_in' => 'File yang diupload bukan gambar',
                    'max_size' => 'Ukuran gambar terlalu besar, maksimal 4MB',
                    'max_dims' => 'Dimensi gambar terlalu besar, maksimal 800x800'
                ]
            ],

        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to('admin/profile/' . $id)->withInput();
        }
        $file = $this->request->getFile('user_image');
        $userItem = $this->user->find($id);
        $oldImage = $userItem->user_image;

        if ($file->isValid() && !$file->hasMoved()) {
            if (file_exists('assets/img/user_profile/' . $oldImage)) {
                unlink('assets/img/user_profile/' . $oldImage);
                $imageName = $file->getRandomName();
                $file->move('assets/img/user_profile/', $imageName);
                $data = [
                    'email' => trim($this->request->getVar('email')),
                    'username' => trim($this->request->getVar('username')),
                    'fullname' => trim($this->request->getVar('fullname')),
                    'bio' => trim($this->request->getVar('bio')),
                    'user_image' => $imageName,

                ];
            }
        } else {
            $data = [
                'email' => trim($this->request->getVar('email')),
                'username' => trim($this->request->getVar('username')),
                'fullname' => trim($this->request->getVar('fullname')),
                'bio' => trim($this->request->getVar('bio')),

            ];
        }
        $this->user->update($id, $data);
        session()->setFlashdata('message', 'Update Data Berhasil');
        return redirect()->to('admin/profile/' . $id);
    }

    //user
    public function userlist()
    {
        $data['users'] = $this->user->findAll();

        return view('admin/data/user', $data);
    }

    public function adduser()
    {
        return view('admin/data/create/add-user');

        $users = model(User::class);

        // Validate basics first since some password rules rely on these fields
        $rules = config('Validation')->registrationRules ?? [
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validate passwords since they can only be validated properly here
        $rules = [
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        $user              = new User($this->request->getPost($allowedPostFields));

        $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        // Ensure default group gets assigned if set
        if (!empty($this->config->defaultUserGroup)) {
            $users = $users->withGroup($this->config->defaultUserGroup);
        }

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // Success!
        // return redirect('admin/data/user', $data)->with('message', lang('Auth.registerSuccess'));
        // return view;

    }





    //team
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
        $team = $this->team->find($id);
        if ($team->logo->hasFile() || $team->logo != 'default.png') {
            unlink('assets/img/team_logo/' . $team->logo);
        }
        $this->team->delete($id);
        session()->setFlashdata('message', 'Hapus Data Team Berhasil');
        return redirect()->to('/admin/data/team');
    }






    //match
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

        $data = [
            'kd_pertandingan' => $getKode->get_kdpertandingan(),
            'kd_team1' => $this->request->getVar('kd_team1'),
            'kd_team2' => $this->request->getVar('kd_team2'),
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

        if ($file->isValid() && !$file->hasMoved()) {
            if (file_exists('assets/img/banner/' . $oldImage)) {
                unlink('assets/img/banner/' . $oldImage);
                $imageName = $file->getRandomName();
                $file->move('assets/img/banner/', $imageName);
                $data = [
                    'kd_team1' => $this->request->getVar('kd_team1'),
                    'kd_team2' => $this->request->getVar('kd_team2'),
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

    public function delete_pertandingan($id)
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


    //stadion


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

    //ticket
    public function tiketlist()
    {
        return view('admin/data/tiket');
    }

    //transaksi
    public function transaksilist()
    {
        return view('admin/data/transaksi');
    }
}
