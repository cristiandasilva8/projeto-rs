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
        'latitude',
        'longitude',
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

    public function getVagaComEmpresa($id)
    {
        return $this->select('vagas.*, admin_usuarios.nome as empresa_nome, admin_usuarios.endereco_completo as empresa_endereco, admin_usuarios.imagem as empresa_imagem, admin_usuarios.descricao as empresa_descricao, admin_usuarios.nome_responsavel as empresa_nome_responsavel, admin_usuarios.email as empresa_email, admin_usuarios.telefone as empresa_telefone')
                    ->join('admin_usuarios', 'vagas.empresa_id = admin_usuarios.id')
                    ->where('vagas.salario IS NOT NULL')
                    ->where('vagas.cidade IS NOT NULL')
                    ->where('vagas.estado IS NOT NULL')
                    ->where('vagas.id', $id)
                    ->orderBy('vagas.id', 'DESC')
                    ->first();
    }

    public function getUltimasVagasComEmpresa($limit = 6)
    {
        return $this->select('vagas.*, admin_usuarios.nome as empresa_nome, admin_usuarios.imagem as empresa_imagem, admin_usuarios.descricao as empresa_descricao, admin_usuarios.nome_responsavel as empresa_nome_responsavel, admin_usuarios.email as empresa_email, admin_usuarios.telefone as empresa_telefone')
                    ->join('admin_usuarios', 'vagas.empresa_id = admin_usuarios.id')
                    ->where('admin_usuarios.id_grupo', 2)
                    ->where('vagas.salario IS NOT NULL AND vagas.salario != ""')
                    ->where('vagas.cidade IS NOT NULL AND vagas.cidade != ""')
                    ->where('vagas.estado IS NOT NULL AND vagas.estado != ""')
                    ->where('vagas.deleted_at', null)
                    ->orderBy('vagas.id', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
    
    public function getVagasComCandidatos()
    {
        return $this->db->table('vagas')
            ->select('vagas.*, COUNT(candidato_vagas.id_usuario) as num_candidatos')
            ->join('candidato_vagas', 'vagas.id = candidato_vagas.id_vaga', 'left')
            ->where('vagas.salario IS NOT NULL AND vagas.salario != ""')
            ->where('vagas.cidade IS NOT NULL AND vagas.cidade != ""')
            ->where('vagas.estado IS NOT NULL AND vagas.estado != ""')
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
            ->orLike('cidade', $search)
            ->orLike('setor', $search)
            ->orLike('descricao', $search)
            ->groupEnd()
            ->countAllResults();
    }
}
