<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\User as ModelsUser;


class User extends BaseController
{
    protected $order;

    public function __construct()
    {
        helper('tglindo_helper');
        $this->user = new ModelsUser();
    }

    public function index($id)
    {
        $this->order = new Order();


        $data['tiket'] = $this->order->where('id_user', user()->id)->findAll();
        return view('user/profile', $data);
    }

    public function download($id)
    {
        return $this->response->download('assets/etiket/' . $id . '.pdf', null);
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
            return redirect()->to('user/profile/' . $id)->withInput();
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
        return redirect()->to('user/profile/' . $id);
    }
}
