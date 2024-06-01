<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePublicacoesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'usuario_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'descricao' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'data_publicacao' => [
                'type' => 'DATE',
                'null' => true,
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
        $this->forge->addForeignKey('usuario_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('publicacoes');
    }

    public function down()
    {
        $this->forge->dropTable('publicacoes');
    }
}
