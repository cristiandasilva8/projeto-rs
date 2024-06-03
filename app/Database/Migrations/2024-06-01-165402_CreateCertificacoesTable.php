<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCertificacoesTable extends Migration
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
            'certificacao' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'instituicao' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'data_emissao' => [
                'type' => 'DATE',
            ],
            'data_validade' => [
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
        $this->forge->createTable('certificacoes');
    }

    public function down()
    {
        $this->forge->dropTable('certificacoes');
    }
}
