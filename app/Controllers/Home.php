<?php

namespace App\Controllers;

use App\Models\VagasModel;

class Home extends BaseController
{
    public function index(): string
    {
        $vagas = new VagasModel();

        $todasVagas = $vagas->findAll(6);    
        $numVagas = $vagas->countAllResults();
        
        return view('home', compact('todasVagas', 'numVagas'));
    }
}
