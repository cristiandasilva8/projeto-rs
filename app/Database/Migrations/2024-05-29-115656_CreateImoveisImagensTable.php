<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateImoveisImagensTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_imovel' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'caminho_imagem' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->createTable('imoveis_imagens');
    }

    public function down()
    {
        $this->forge->dropTable('imoveis_imagens');
    }
}
