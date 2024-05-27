<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VagasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nome' => 'Desenvolvedor Backend',
                'empresa_id' => '1',
                'localizacao' => '-23.550520, -46.633308', // Coordenadas para São Paulo
                'setor' => 'Tecnologia',
                'quantidade_limite' => 2,
                'requisitos' => 'PHP, Laravel, MySQL',
                'salario' => 8000.00,
                'descricao' => 'Responsável pelo desenvolvimento de APIs.',
                'outros_beneficios' => 'Vale Refeição, Vale Transporte',
                'tipo' => 'clt',
                'id_categoria' => 1,
                'cep' => '01000-000',
                'cidade' => 'São Paulo',
                'estado' => 'SP',
            ],
            [
                'nome' => 'Analista de Marketing',
                'empresa_id' => '2',
                'localizacao' => '-22.906847, -43.172896', // Coordenadas para Rio de Janeiro
                'setor' => 'Marketing',
                'quantidade_limite' => 1,
                'requisitos' => 'SEO, Google Analytics, Social Media',
                'salario' => 5000.00,
                'descricao' => 'Responsável por campanhas de marketing digital.',
                'outros_beneficios' => 'Vale Refeição, Plano de Saúde',
                'tipo' => 'temporario',
                'id_categoria' => 2,
                'cep' => '20000-000',
                'cidade' => 'Rio de Janeiro',
                'estado' => 'RJ',
            ],
            [
                'nome' => 'Engenheiro de Software',
                'empresa_id' => '3',
                'localizacao' => '-19.917299, -43.934559', // Coordenadas para Belo Horizonte
                'setor' => 'Tecnologia',
                'quantidade_limite' => 3,
                'requisitos' => 'Java, Spring, Microservices',
                'salario' => 10000.00,
                'descricao' => 'Desenvolvimento e manutenção de sistemas.',
                'outros_beneficios' => 'Vale Refeição, Seguro Saúde',
                'tipo' => 'clt',
                'id_categoria' => 1,
                'cep' => '30140-000',
                'cidade' => 'Belo Horizonte',
                'estado' => 'MG',
            ],
            [
                'nome' => 'Gerente de Projetos',
                'empresa_id' => '4',
                'localizacao' => '-15.7801, -47.9292', // Coordenadas para Brasília
                'setor' => 'Administração',
                'quantidade_limite' => 1,
                'requisitos' => 'PMP, Gestão de Projetos, Scrum',
                'salario' => 12000.00,
                'descricao' => 'Gerenciamento de projetos de TI.',
                'outros_beneficios' => 'Vale Refeição, Plano de Saúde',
                'tipo' => 'clt',
                'id_categoria' => 3,
                'cep' => '70000-000',
                'cidade' => 'Brasília',
                'estado' => 'DF',
            ],
            [
                'nome' => 'Designer Gráfico',
                'empresa_id' => '5',
                'localizacao' => '-25.4284, -49.2733', // Coordenadas para Curitiba
                'setor' => 'Design',
                'quantidade_limite' => 2,
                'requisitos' => 'Photoshop, Illustrator, InDesign',
                'salario' => 4000.00,
                'descricao' => 'Criação de peças gráficas e layouts.',
                'outros_beneficios' => 'Vale Refeição, Vale Transporte',
                'tipo' => 'temporario',
                'id_categoria' => 2,
                'cep' => '80000-000',
                'cidade' => 'Curitiba',
                'estado' => 'PR',
            ],
            [
                'nome' => 'Consultor de Vendas',
                'empresa_id' => '6',
                'localizacao' => '-30.0346, -51.2177', // Coordenadas para Porto Alegre
                'setor' => 'Vendas',
                'quantidade_limite' => 4,
                'requisitos' => 'Vendas, Atendimento ao Cliente, Negociação',
                'salario' => 3000.00,
                'descricao' => 'Consultoria em vendas e atendimento ao cliente.',
                'outros_beneficios' => 'Vale Refeição, Comissão',
                'tipo' => 'clt',
                'id_categoria' => 3,
                'cep' => '90000-000',
                'cidade' => 'Porto Alegre',
                'estado' => 'RS',
            ],
            [
                'nome' => 'Assistente Administrativo',
                'empresa_id' => '7',
                'localizacao' => '-23.561684, -46.625378', // Coordenadas para São Paulo
                'setor' => 'Administração',
                'quantidade_limite' => 2,
                'requisitos' => 'Pacote Office, Organização, Comunicação',
                'salario' => 3500.00,
                'descricao' => 'Assistência administrativa e suporte geral.',
                'outros_beneficios' => 'Vale Refeição, Vale Transporte',
                'tipo' => 'clt',
                'id_categoria' => 3,
                'cep' => '01001-000',
                'cidade' => 'São Paulo',
                'estado' => 'SP',
            ],
            [
                'nome' => 'Analista de Suporte Técnico',
                'empresa_id' => '8',
                'localizacao' => '-22.909938, -43.209373', // Coordenadas para Rio de Janeiro
                'setor' => 'Tecnologia',
                'quantidade_limite' => 3,
                'requisitos' => 'Redes, Windows, Linux',
                'salario' => 4500.00,
                'descricao' => 'Suporte técnico e manutenção de sistemas.',
                'outros_beneficios' => 'Vale Refeição, Plano de Saúde',
                'tipo' => 'temporario',
                'id_categoria' => 1,
                'cep' => '20010-000',
                'cidade' => 'Rio de Janeiro',
                'estado' => 'RJ',
            ],
        ];

        $this->db->table('vagas')->insertBatch($data);
    }
}
