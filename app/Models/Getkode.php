<?php

namespace App\Models;

use CodeIgniter\Model;

class Getkode extends Model
{

    // protected $db = \Config\Database::connect();

    //ini fungsi untuk generate kode team secara otomatis
    function get_kdteam()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kd_team,3)) AS kd_max FROM teams");
        $kd = "";
        if ($q->getNumRows() > 0) {
            foreach ($q->getResult() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "00001";
        }
        return "T" . $kd;
    }

    //ini fungsi untuk generate kode stadion secara otomatis
    function get_kdstadion()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kd_stadion,3)) AS kd_max FROM stadions");
        $kd = "";
        if ($q->getNumRows() > 0) {
            foreach ($q->getResult() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "00001";
        }
        return "STD" . $kd;
    }

    //ini fungsi untuk generate kode pertandingan secara otomatis
    function get_kdpertandingan()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kd_pertandingan,3)) AS kd_max FROM pertandingans");
        $kd = "";
        if ($q->getNumRows() > 0) {
            foreach ($q->getResult() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "00001";
        }
        return "PRT" . $kd;
    }
}
