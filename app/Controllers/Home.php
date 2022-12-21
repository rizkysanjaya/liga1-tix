<?php

namespace App\Controllers;

use App\Models\Team;
use App\Models\Pertandingan;


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
}
