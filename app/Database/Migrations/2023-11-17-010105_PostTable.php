<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PostTable extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'contraint' => 255,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'contraint' => 255,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'contraint' => 255,
            ],
            'content' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'contraint' => true,
            ],
        ];
        $this->forge->addField($fileds);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('author_id', 'authors', 'id');
        $this->forge->createTable('posts');
    }

    public function down()
    {
        $this->forge->dropTable('posts');
    }
}
