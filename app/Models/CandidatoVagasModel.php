<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidatoVagasModel extends Model
{
    protected $table            = 'candidato_vagas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_usuario',
        'id_vaga',
        'selecionado'
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

    public function getCandidatosPorVaga($vagaId)
    {
        return $this->db->table($this->table)
            ->join('users', 'users.id = candidato_vagas.id_usuario')
            ->join('auth_identities', 'auth_identities.user_id = users.id')
            ->join('informacoes_pessoais', 'informacoes_pessoais.usuario_id = users.id', 'left')
            ->where('candidato_vagas.id_vaga', $vagaId)
            ->select('users.id, users.username, auth_identities.secret as email, informacoes_pessoais.telefone, informacoes_pessoais.whatsapp, candidato_vagas.selecionado')
            ->get()
            ->getResult();
    }

    public function selecionarCandidato($candidatoId, $vagaId){
        return $this->where('id_usuario', $candidatoId)
                        ->where('id_vaga', $vagaId)
                        ->set(['selecionado' => 1])
                        ->update();
    }

}
