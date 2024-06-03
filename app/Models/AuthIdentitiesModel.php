<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthIdentitiesModel extends Model
{
    protected $table = 'auth_identities'; // Assegure-se de que este é o nome correto da tabela
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'type', 'secret', 'secret2', 'expires'];

    // Método para verificar se uma identidade já existe
    public function identityExists($email)
    {
        return $this->asArray()
                    ->where(['secret' => $email]) // Assume que 'secret' armazena o email e 'type' especifica o tipo de identidade
                    ->first();
    }

    public function updatePassword($user_id, $password){
        return $this->where('user_id', $user_id)->set(['secret2' => $password])->update();
    }
}
