<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        //added table order
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kd_order' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'id_user' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'kd_pertandingan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'kd_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'kd_tiket' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tribun' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'jml_tiket' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'tgl_order' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'no_tlp' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'expired' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'qrcode' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('kd_order');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        //
        $this->forge->dropTable('orders');
    }
}
