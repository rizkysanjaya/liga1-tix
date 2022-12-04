<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Stadion extends Migration
{
    public function up()
    {
        //added table stadion
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kd_stadion' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'nama_stadion' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'alamat_stadion' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kapasitas' => [
                'type' => 'INT',
                'constraint' => 11,
            ]

        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addUniqueKey('kd_stadion');
        $this->forge->createTable('stadions', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('stadions');
    }
}
