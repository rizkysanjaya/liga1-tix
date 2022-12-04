<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Team extends Migration
{
    public function up()
    {
        //added table team
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kd_team' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama_team' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'deskripsi' => [
                'type' => 'text',
                'constraint' => '255',
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'kota' => [
                'type' => 'text',
                'constraint' => '100',
                'null' => true,
            ],
            
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addUniqueKey('kd_team');

		$this->forge->createTable('teams', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('teams');
        //
    }
}
