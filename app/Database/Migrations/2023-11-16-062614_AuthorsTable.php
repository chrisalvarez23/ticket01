<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthorsTable extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'birthdate' => [
                'type' => 'DATE',
                'null' => false
            ],
            'is_active' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ];

        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('authors');
    }

    public function down()
    {
        $this->forge->dropTable('authors',true);
     
    }
}
