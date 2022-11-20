<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contact extends Migration
{
    public function up()
    {

		// ini crud coba doang, tabel dummy
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'email'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
			],
			'phone' => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
			],
			'address'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
		]);

		$this->forge->addKey('id', TRUE);

		$this->forge->createTable('contacts', TRUE);

		//buat table lain disini >>>
		
    }

    public function down()
    {
        $this->forge->dropTable('contacts');
    }
}