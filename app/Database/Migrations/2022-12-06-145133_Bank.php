<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bank extends Migration
{
    public function up()
    {
        //added table bank
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kd_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'nama_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'no_rekening' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'atas_nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'logo_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('kd_bank');
        $this->forge->createTable('bank');
    }

    public function down()
    {
        //
        $this->forge->dropTable('bank');
    }
}
