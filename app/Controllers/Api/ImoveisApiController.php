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
    
}
