<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;


class User extends BaseController
{
    protected $order;

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
            return redirect()->to('user/profile/' . $id)->withInput();
        }
        $file = $this->request->getFile('user_image');
        $userItem = $this->user->find($id);
        $oldImage = $userItem->user_image;

        // //check if username and email is changed or not
        // if ($userItem['username'] == $this->request->getVar('username') && $userItem['email'] == $this->request->getVar('email')) {
        //     $this->user->save([
        //         'id' => $id,
        //         'fullname' => $this->request->getVar('fullname'),
        //         'bio' => $this->request->getVar('bio'),
        //     ]);
        //     session()->setFlashdata('success', 'Profile berhasil diupdate');
        //     return redirect()->to('user/profile/' . $id);
        // }


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
        return redirect()->to('user/profile/' . $id);
    }
}
