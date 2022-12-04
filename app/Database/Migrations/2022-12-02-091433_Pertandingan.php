<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pertandingan extends Migration
{
    public function up()
    {
        //added table pertandingan
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kd_pertandingan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'kd_team1' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'kd_team2' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'kd_stadion' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'waktu' => [
                'type' => 'TIME',
            ],
            'banner_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'skor_team1' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'skor_team2' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'harga_tb_timur' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'harga_tb_barat' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'harga_tb_vip' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'harga_tb_vvip' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ]

        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addKey(['kd_team1', 'kd_team2', 'kd_stadion'], TRUE);
        $this->forge->addUniqueKey('kd_pertandingan');
        $this->forge->addForeignKey('kd_team1', 'teams', 'kd_team');
        $this->forge->addForeignKey('kd_team2', 'teams', 'kd_team');
        $this->forge->addForeignKey('kd_stadion', 'stadions', 'kd_stadion');
        $this->forge->createTable('pertandingans', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('pertandingans');
    }
}
