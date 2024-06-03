<?php

namespace App\Models;

use CodeIgniter\Model;

class ImoveisModel extends Model
{
    protected $table            = 'imoveis';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'descricao',
        'id_empresa',
        'preco',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'tipo',
        'id_tipo_propriedade',
        'latitude',
        'longitude',
        'caracteristicas',
        'status',
        'foto_destaque',
        'area_construida',
        'area_terreno',
        'qtd_quartos',
        'qtd_banheiros',
        'qtd_vagas_garagem',
        'qtd_suites',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['convertData'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['convertData'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function insertImovel($data)
    {
        $data = (object)$data;
        return $this->insert($data);
    }

    public function getImoveis()
    {
        return $this->db->table('imoveis')
            ->select('imoveis.id, imoveis.descricao, imoveis.preco, imoveis.tipo, admin_usuarios.nome as empresa, imoveis.status')
            ->join('admin_usuarios', 'admin_usuarios.id = imoveis.id_empresa')
            ->where('admin_usuarios.id_grupo', 3)
            ->where('imoveis.deleted_at', null)
            ->get()
            ->getResultArray();
    }

    public function findAllComImobiliaria($dados)
    {
        $this->select('imoveis.*, admin_usuarios.nome as nome_imobiliaria, admin_usuarios.imagem as logo_imobiliaria, tipo_propriedades.nome as nome_tipo_propriedade,');

        // Filtro por nome parcial
        if (!empty($dados['termo'])) {
            $this->like('imoveis.descricao', $dados['termo']);
        }
        if (!empty($dados['imobiliaria'])) {
            $this->like('imoveis.id_empresa', $dados['imobiliaria']);
        }
        if (!empty($dados['cidade'])) {
            $this->where('imoveis.cidade', $dados['cidade']);
        }
        if (!empty($dados['tipo_propriedade'])) {
            $this->where('imoveis.id_tipo_propriedade', $dados['tipo_propriedade']);
        }
        if (!empty($dados['preco'])) {
            $this->where('imoveis.preco <=', v2p($dados['preco']));
        }

        // Join com a tabela admin_usuario
        $this->join('admin_usuarios', 'admin_usuarios.id = imoveis.id_empresa')
            ->join('tipo_propriedades', 'imoveis.id_tipo_propriedade = tipo_propriedades.id')
             ->where('admin_usuarios.id_grupo', 3)
             ->where('imoveis.deleted_at', null);

        return $this->get()->getResultArray();
    }

    /**
     * Busca todos os imóveis com latitude e longitude preenchidos e dentro de um raio de 10 km das coordenadas fornecidas.
     *
     * @param float $latitude
     * @param float $longitude
     * @return array
     */
    public function buscarImoveisProximos($latitude, $longitude)
    {
        // Raio da Terra em km
        $earthRadius = 6371;

        // Query para buscar imóveis dentro de um raio de 10 km das coordenadas fornecidas
        $query = $this->db->query("
            SELECT 
                id, descricao, latitude, longitude,
                ($earthRadius * ACOS(COS(RADIANS(?)) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(latitude)))) AS distance
            FROM 
                {$this->table}
            WHERE 
                latitude IS NOT NULL 
                AND latitude != '' 
                AND longitude IS NOT NULL 
                AND longitude != ''
            HAVING 
                distance <= 10
            ORDER BY 
                distance ASC
        ", [$latitude, $longitude, $latitude]);

        $result = $query->getResultArray();

        // Formatar o resultado no formato esperado
        $formattedResult = array_map(function($row) {
            return [
                'latitude' => (float) $row['latitude'],
                'longitude' => (float) $row['longitude'],
                'title' => $row['descricao']
            ];
        }, $result);

        return $formattedResult;
    }

    public function getUltimosImoveisComEmpresa($limit = 6)
    {
        return $this->select('imoveis.*, tipo_propriedades.nome as nome_tipo_propriedade, admin_usuarios.nome as empresa_nome, admin_usuarios.imagem as empresa_imagem, admin_usuarios.descricao as empresa_descricao, admin_usuarios.nome_responsavel as empresa_nome_responsavel, admin_usuarios.email as empresa_email, admin_usuarios.telefone as empresa_telefone')
                    ->join('admin_usuarios', 'imoveis.id_empresa = admin_usuarios.id')
                    ->join('tipo_propriedades', 'imoveis.id_tipo_propriedade = tipo_propriedades.id')
                    ->where('admin_usuarios.id_grupo', 3)
                    ->where('imoveis.preco IS NOT NULL AND imoveis.preco != ""')
                    ->where('imoveis.logradouro IS NOT NULL AND imoveis.logradouro != ""')
                    ->where('imoveis.cidade IS NOT NULL AND imoveis.cidade != ""')
                    ->where('imoveis.bairro IS NOT NULL AND imoveis.bairro != ""')
                    ->where('imoveis.foto_destaque IS NOT NULL AND imoveis.foto_destaque != ""')
                    ->where('imoveis.tipo IS NOT NULL AND imoveis.tipo != ""')
                    ->where('imoveis.status', 1)
                    ->orderBy('imoveis.id', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    public function getImovelComEmpresa($id)
    {
        $imovel = $this->select('imoveis.*, tipo_propriedades.nome as nome_tipo_propriedade, admin_usuarios.nome as empresa_nome, admin_usuarios.imagem as empresa_imagem, admin_usuarios.descricao as empresa_descricao, admin_usuarios.nome_responsavel as empresa_nome_responsavel, admin_usuarios.email as empresa_email, admin_usuarios.telefone as empresa_telefone')
                        ->join('admin_usuarios', 'imoveis.id_empresa = admin_usuarios.id')
                        ->join('tipo_propriedades', 'imoveis.id_tipo_propriedade = tipo_propriedades.id')
                        ->where('imoveis.status', 1)
                        ->where('imoveis.id', $id)
                        ->orderBy('imoveis.id', 'DESC')
                        ->first();

        // Busca todas as imagens vinculadas a este imóvel
        $imovel->imagens = $this->getImagensDoImovel($id);

        return $imovel;
    }

    public function getImagensDoImovel($id_imovel)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('imoveis_imagens');
        return $builder->select('caminho_imagem')
                       ->where('id_imovel', $id_imovel)
                       ->get()
                       ->getResultArray();
    }

    public function getCidades()
    {
        return $this->select('cidade')
                    ->distinct()
                    ->orderBy('cidade', 'ASC')
                    ->findAll();
    }


    protected function convertData(array $data)
    {
        if (isset($data['data']['area_construida'])) {
            $data['data']['area_construida'] = $this->convertAreaToNumber($data['data']['area_construida']);
        }
        if (isset($data['data']['area_terreno'])) {
            $data['data']['area_terreno'] = $this->convertAreaToNumber($data['data']['area_terreno']);
        }
        if (isset($data['data']['qtd_quartos'])) {
            $data['data']['qtd_quartos'] = (int) $data['data']['qtd_quartos'];
        }
        if (isset($data['data']['qtd_banheiros'])) {
            $data['data']['qtd_banheiros'] = (int) $data['data']['qtd_banheiros'];
        }
        if (isset($data['data']['qtd_vagas_garagem'])) {
            $data['data']['qtd_vagas_garagem'] = (int) $data['data']['qtd_vagas_garagem'];
        }
        if (isset($data['data']['qtd_suites'])) {
            $data['data']['qtd_suites'] = (int) $data['data']['qtd_suites'];
        }
        if (isset($data['data']['preco'])) {
            $data['data']['preco'] = v2p($data['data']['preco']);
        }

        return $data;
    }

    private function convertAreaToNumber($area)
    {
        // Remove o sufixo ' m²' e converte para float
        return (float) str_replace(' m²', '', $area);
    }
}
