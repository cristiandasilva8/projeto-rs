<?php

namespace App\Models;

use CodeIgniter\Model;

class VagasModel extends Model
{
    protected $table            = 'vagas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nome',
        'empresa_id',
        'localizacao',
        'setor',
        'quantidade_limite',
        'requisitos',
        'salario',
        'descricao',
        'outros_beneficios',
        'tipo',
        'id_categoria',
        'cep',
        'cidade',
        'estado',
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

    public function insertVaga($data)
    {
        $data = (object)$data;
        return $this->insert($data);
    }
    public function getVagasComCandidatos()
    {
        return $this->db->table('vagas')
            ->select('vagas.*, COUNT(candidato_vagas.id_usuario) as num_candidatos')
            ->join('candidato_vagas', 'vagas.id = candidato_vagas.id_vaga', 'left')
            ->where('vagas.deleted_at', null)  // Adiciona condição para incluir apenas registros não excluídos
            ->groupBy('vagas.id')
            ->get()
            ->getResultArray();
    }

    /**
     * Conta os registros que correspondem ao termo de busca em várias colunas.
     *
     * @param string $search Termo de busca.
     * @return int Número de registros filtrados.
     */
    public function getCountLike($search)
    {
        return $this->table($this->table)
            ->select('id')
            ->groupStart()
            ->like('nome', $search)
            ->orLike('localizacao', $search)
            ->orLike('setor', $search)
            ->orLike('descricao', $search)
            ->groupEnd()
            ->countAllResults();
    }
}
