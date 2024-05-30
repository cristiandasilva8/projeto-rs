<?php

namespace App\Controllers\Api;

use App\Models\CandidatoVagasModel;
use CodeIgniter\Config\Factories;
use CodeIgniter\RESTful\ResourceController;


class CandidatosApiController extends ResourceController
{
    private $_candidadosModel;
    public function __construct() {
        $this->_candidadosModel = Factories::models(CandidatoVagasModel::class);
    }

    public function index()
    {
        //
    }
}
