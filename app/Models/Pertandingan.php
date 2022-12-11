<?php

namespace App\Models;

use CodeIgniter\Model;

class Pertandingan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pertandingans';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kd_pertandingan', 'kd_team1', 'kd_team2', 'nama_team1', 'nama_team2', 'logo_team1', 'logo_team2', 'kd_stadion', 'tanggal', 'waktu', 'banner_image', 'skor_team1', 'skor_team2', 'harga_tb_timur', 'harga_tb_barat', 'harga_tb_vip', 'harga_tb_vvip', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
