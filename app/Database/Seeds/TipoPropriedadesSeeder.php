<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoPropriedadesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nome' => 'Apartamento'],
            ['nome' => 'Casa'],
            ['nome' => 'Cobertura'],
            ['nome' => 'Flat'],
            ['nome' => 'Terreno'],
            ['nome' => 'Chácara'],
            ['nome' => 'Sítio'],
            ['nome' => 'Fazenda'],
            ['nome' => 'Loja'],
            ['nome' => 'Sala Comercial'],
            ['nome' => 'Galpão'],
            ['nome' => 'Armazém'],
            ['nome' => 'Prédio'],
            ['nome' => 'Pousada'],
            ['nome' => 'Hotel'],
            ['nome' => 'Kitnet'],
            ['nome' => 'Duplex'],
            ['nome' => 'Triplex'],
            ['nome' => 'Conjunto Comercial'],
            ['nome' => 'Lote'],
            ['nome' => 'Barracão'],
            ['nome' => 'Casa de Condomínio'],
            ['nome' => 'Loft'],
            ['nome' => 'Casa de Vila'],
        ];

        // Simple Queries
        foreach ($data as $tipo) {
            $this->db->table('tipo_propriedades')->insert($tipo);
        }
    }
}
