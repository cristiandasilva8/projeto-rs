<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateExperienciasProfissionaisTable extends Migration
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
            'empresa' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'cargo' => [
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
            'responsabilidades' => [
                'type' => 'TEXT',
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
        $this->forge->createTable('experiencias_profissionais');
    }

    public function down()
    {
        $this->forge->dropTable('experiencias_profissionais');
    }
}
