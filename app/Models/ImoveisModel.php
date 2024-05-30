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
        'latitude',
        'longitude',
        'caracteristicas',
        'status',
        'foto_destaque',
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
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
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
}
