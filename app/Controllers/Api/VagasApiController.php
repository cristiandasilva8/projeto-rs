<?php

namespace App\Controllers\Api;

use App\Models\VagasModel;
use CodeIgniter\Config\Factories;
use CodeIgniter\RESTful\ResourceController;

class VagasApiController extends ResourceController {

    private $_vagasModel;

    public function __construct() {
        $this->_vagasModel = Factories::models(VagasModel::class);
    }
    public function index()
    {        
        return $this->respond($this->_vagasModel->findAll(), 200);
    }
    
    public function show($id = null)
    {
        // if(empty($id))  
        //     return $this->failNotFound("Não foi encontrado esse recurso de acesso");

        dd($id);
            return $this->respond($this->_vagasModel->find($id), 200);
    }
}
