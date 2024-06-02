<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInformacoesPessoaisTable extends Migration
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
            'endereco' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'foto_perfil' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
            ],
            'whatsapp' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
            ],
            'linkedin' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'instagram' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'facebook' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->createTable('informacoes_pessoais');
    }

    public function down()
    {
        $this->forge->dropTable('informacoes_pessoais');
    }
}

