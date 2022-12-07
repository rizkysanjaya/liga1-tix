<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tiket extends Migration
{
    public function up()
    {
        //added table tiket
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kd_tiket' => [
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
            'harga' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'etiket' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]

        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('kd_tiket');
        $this->forge->createTable('tiket');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tiket');
    }
}
