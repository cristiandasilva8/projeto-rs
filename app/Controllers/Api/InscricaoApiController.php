<?php

namespace App\Controllers\Api;

use App\Models\CandidatoVagasModel;
use App\Models\UsuarioModel;
use App\Models\VagasModel;
use CodeIgniter\Config\Factories;
use CodeIgniter\Email\Email;
use CodeIgniter\Events\Events;
use CodeIgniter\RESTful\ResourceController;
use PHPUnit\Event\Event;

class InscricaoApiController extends ResourceController
{
    private $_vagaModel;
    private $_usuarioModel;
    private $_candidatoVagaModel;

    public function __construct() {
        $this->_vagaModel = Factories::models(VagasModel::class);
        $this->_usuarioModel = Factories::models(UsuarioModel::class);
        $this->_candidatoVagaModel = Factories::models(CandidatoVagasModel::class);
    }

    public function index()
    {
        return $this->failNotFound("Não foi encontrado esse recurso de acesso");
    }

    public function show($id = null)
    {
        return $this->failNotFound("Não foi encontrado esse recurso de acesso");
    }

    public function create()
    {
        
        if(!$this->request->is('post'))
            return $this->failNotFound("Não foi encontrado esse recurso de acesso");

        $idUsuario = $this->request->getPost('id_usuario');
        $idVaga = $this->request->getPost('id_vaga');        
        
        $usuario = $this->_usuarioModel->find($idUsuario);
        $vaga = $this->_vagaModel->find($idVaga);

        
        if(empty($usuario))
            return $this->failNotFound("Usuário não encontrado: $idUsuario");

        if(empty($vaga))
            return $this->failNotFound("Vaga não encontrado: $idVaga");        

        $dados = ['id_usuario' => $idUsuario, 'id_vaga' => $idVaga, 'deleted_at' => null];                
         
        $jaSeCandidatou = $this->_candidatoVagaModel->where($dados)->findAll();       

        if(! empty($jaSeCandidatou))
            return $this->failResourceExists("Candidato já cadastrado para essa vaga!");

        if(! $this->_candidatoVagaModel->save($dados))
            return $this->failServerError("Algum erro interno aconteceu no servidor ". implode(',' , $dados));

        unset($dados['deleted_at']);

        Events::trigger('email', "teste@teste.com", "", "", "");

        return $this->respondCreated($dados, "Candidato inscrito na vaga");        
    }   
}
