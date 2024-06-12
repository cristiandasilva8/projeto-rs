<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEducacoesTable extends Migration
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
            'instituicao' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'curso' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'data_inicio' => [
                'type' => 'DATE',
            ],
            'data_fim' => [
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
        $this->forge->createTable('educacoes');
    }

    public function down()
    {
        $this->forge->dropTable('educacoes');
    }
}

