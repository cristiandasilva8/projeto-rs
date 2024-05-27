<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelaVagas extends Migration
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
            'nome' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'empresa_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'localizacao' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'setor' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'quantidade_limite' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'requisitos' => [
                'type'       => 'TEXT',
            ],
            'salario' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'descricao' => [
                'type' => 'TEXT',
            ],
            'outros_beneficios' => [
                'type' => 'TEXT',
            ],
            'tipo' => [
                'type'       => 'ENUM',
                'constraint' => ['CLT', 'Temporario'],
            ],
            'id_categoria' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'cep' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'cidade' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'estado' => [
                'type'       => 'VARCHAR',
                'constraint' => '2',
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
        $this->forge->addForeignKey('id_categoria', 'categorias', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('vagas');
    }

    public function down()
    {
        $this->forge->dropTable('vagas');
    }
}
