<?php

namespace App\Controllers;
// use Myth\Auth\Controllers\AuthController;

class Home extends BaseController
{

    public function index()
    {
        if (in_groups('admin')) {
            return redirect()->to(base_url('/admin/dashboard'));
        } else {
            return view('/user/landpage');
        }
    }

    public function landpage()
    {
        return view('/user/landpage');
    }
}
