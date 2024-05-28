<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminUsuariosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nome' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'senha' => password_hash('superadmin123', PASSWORD_DEFAULT),
                'endereco_completo' => null,
                'telefone' => null,
                'celular' => null,
                'cpf_cnpj' => null,
                'creci' => null,
                'id_grupo' => 1 // Assume que superadmin tem ID 1
            ],
            [
                'nome' => 'Empresa',
                'email' => 'empresa@example.com',
                'senha' => password_hash('empresa123', PASSWORD_DEFAULT),
                'endereco_completo' => '123 Empresa St, Business City',
                'telefone' => '555-1234',
                'celular' => '555-5678',
                'cpf_cnpj' => '00.000.000/0001-00',
                'creci' => null,
                'id_grupo' => 2 // Assume que empresa tem ID 2
            ],
            [
                'nome' => 'Imobiliária',
                'email' => 'imobiliaria@example.com',
                'senha' => password_hash('imobiliaria123', PASSWORD_DEFAULT),
                'endereco_completo' => '789 Imobiliária Ave, Real Estate City',
                'telefone' => '555-8765',
                'celular' => '555-4321',
                'cpf_cnpj' => '00.000.000/0001-99',
                'creci' => '1234567',
                'id_grupo' => 3 // Assume que imobiliária tem ID 3
            ]
        ];

        $this->db->table('admin_usuarios')->insertBatch($data);
    }
}
