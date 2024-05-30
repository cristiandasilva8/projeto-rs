<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admin_usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nome',
        'email',
        'senha',
        'endereco_completo',
        'telefone',
        'celular',
        'cpf_cnpj',
        'creci',
        'id_grupo',
        'codigo_verificacao',
        'verificado',
        'imagem',
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

    public function insertUser($data)
    {
        $data = (object)$data;
        $data->senha = password_hash($data->senha, PASSWORD_DEFAULT);
        $data->codigo_verificacao = random_numeric_string(); // Isso gera uma string hexadecimal de 16 caracteres
        
        return $this->insert($data);
    }

    public function verifyUser($codigoVerificacao)
    {
        // Primeiro, verifica se há um usuário com o código fornecido
        $usuario = $this->where('codigo_verificacao', $codigoVerificacao)->first();

        if ($usuario) {
            // Se o usuário existe, atualiza o status para verificado
            return $this->update($usuario->id, ['verificado' => true]);
        }

        return false; // Retorna falso se não houver usuário correspondente
    }
}
