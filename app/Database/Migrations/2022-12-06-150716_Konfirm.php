<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Konfirm extends Migration
{
    public function up()
    {
        //added table konfirm
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kd_konfirm' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'kd_order' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'nama_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'no_rek' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'jml_transfer' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'bukti_transfer' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ]

        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('kd_konfirm');
        $this->forge->createTable('konfirm_order');
    }

    public function down()
    {
        //
        $this->forge->dropTable('konfirm_order');
    }
}
