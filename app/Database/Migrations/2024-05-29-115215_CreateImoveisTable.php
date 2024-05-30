<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateImoveisTable extends Migration
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
            'descricao' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_empresa' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'preco' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'logradouro' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'numero' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'bairro' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'cidade' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'uf' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'cep' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'latitude' => [
                'type'       => 'DOUBLE',
            ],
            'longitude' => [
                'type'       => 'DOUBLE',
            ],
            'caracteristicas' => [
                'type'       => 'TEXT',
            ],
            'status' => [
                'type'       => 'CHAR',
                'constraint' => '1',
            ],
            'tipo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'foto_destaque' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->createTable('imoveis');
    }

    public function down()
    {
        $this->forge->dropTable('imoveis');
    }
}
