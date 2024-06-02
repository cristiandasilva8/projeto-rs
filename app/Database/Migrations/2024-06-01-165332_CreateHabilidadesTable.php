<?php

// Database/Migrations/xxxx_xx_xx_create_habilidades_table.php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHabilidadesTable extends Migration
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
            'habilidade' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'tipo' => [
                'type' => 'VARCHAR',
                'constraint' => '255', // técnica, interpessoal, etc.
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
        $this->forge->createTable('habilidades');
    }

    public function down()
    {
        $this->forge->dropTable('habilidades');
    }
}
