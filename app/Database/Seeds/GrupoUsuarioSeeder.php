<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GrupoUsuarioSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nome_grupo' => 'superadmin'],
            ['nome_grupo' => 'empresa'],
            ['nome_grupo' => 'imobiliaria']
        ];

        $this->db->table('grupo_usuario')->insertBatch($data);
    }
}
