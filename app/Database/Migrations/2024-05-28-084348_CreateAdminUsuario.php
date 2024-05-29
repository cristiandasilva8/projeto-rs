<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminUsuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'imagem' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'senha' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'endereco_completo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true
            ],
            'celular' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true
            ],
            'cpf_cnpj' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true
            ],
            'creci' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true
            ],
            'id_grupo' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
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
        $this->forge->addKey('id_usuario', true);
        $this->forge->addForeignKey('id_grupo', 'grupo_usuario', 'id_grupo', 'CASCADE', 'CASCADE');
        $this->forge->createTable('admin_usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('admin_usuarios');
    }
}
