<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    //dashboard
    public function index()
    {
        return view('admin/dashboard');
    }

    //user
    public function userlist()
    {
        return view('admin/data/user');
    }

    //match
    public function matchlist()
    {
        return view('admin/data/match');
    }

    //team
    public function teamlist()
    {
        return view('admin/data/team');
    }

    //stadion
    public function stadionlist()
    {
        return view('admin/data/stadion');
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
