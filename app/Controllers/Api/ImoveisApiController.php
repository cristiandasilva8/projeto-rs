<?php

namespace App\Controllers\Api;

use CodeIgniter\Config\Factories;
use CodeIgniter\Model;
use CodeIgniter\RESTful\ResourceController;


class ImoveisApiController extends ResourceController 
{
    private $_imoviesModel;

    public function __construct() {
        $this->_imoviesModel = Factories::models(Model::class);
    }

    public function index()
    {
        return $this->respond($this->_imoviesModel->findAll(), 200);
    }

    public function show($id = null)
    {
        
        if(empty($id) || !is_numeric($id)) 
            return $this->failNotFound("Não foi encontrado esse recurso de acesso");
        
        $dados = $this->_imoviesModel->find($id);

        if(empty($dados)) 
            return $this->failNotFound("Não foi encontrado esse recurso de acesso");        

        return $this->respond($dados, 200);
    }
}
