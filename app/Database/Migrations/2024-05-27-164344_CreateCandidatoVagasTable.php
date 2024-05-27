<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCandidatoVagasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_usuario' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_vaga' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'deleted_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_usuario', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_vaga', 'vagas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('candidato_vagas');
    }

    public function down()
    {
        $this->forge->dropTable('candidato_vagas');
    }
}
