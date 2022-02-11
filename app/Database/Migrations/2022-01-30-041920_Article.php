<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Article extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => TRUE,
                'auto_increment' => TRUE
            ],
            'title' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100'
            ],
            'content' => [
                'type'          => 'TEXT',
                'null'          => TRUE
            ],
            'thumbnail' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'          => TRUE
            ],
            'created_at' => [
                'type'          => 'DATETIME',
                'null'          => TRUE
            ],
            'updated_at' => [
                'type'          => 'DATETIME',
                'null'          => TRUE
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('article');
    }

    public function down()
    {
        $this->forge->dropTable('article');
    }
}