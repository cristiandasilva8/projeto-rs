<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nome' => 'Tecnologia'],
            ['nome' => 'Marketing'],
            ['nome' => 'Administração'],
            ['nome' => 'Design'],
            ['nome' => 'Vendas'],
            // Adicione mais categorias conforme necessário
        ];

        $this->db->table('categorias')->insertBatch($data);
    }
}
