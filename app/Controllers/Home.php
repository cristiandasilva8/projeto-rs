<?php

namespace App\Controllers;

use App\Models\Admin\AdminModel;
use App\Models\ImoveisModel;
use App\Models\TipoPropriedadeModel;
use App\Models\VagasModel;

class Home extends BaseController
{
    protected $vagasModel;
    protected $adminModel;
    protected $imoveisModel;
    protected $tipoPropriedadesModel;
    
    public function __construct()
    {
        $this->vagasModel = new VagasModel();
        $this->adminModel = new AdminModel();
        $this->imoveisModel = new ImoveisModel();
        $this->tipoPropriedadesModel = new TipoPropriedadeModel();
    }
    public function index()
    {
        $todasVagas = $this->vagasModel->getUltimasVagasComEmpresa();     
        $numVagas = $this->vagasModel->countAllResults();
        $imobiliarias = $this->adminModel->where('id_grupo', 3)->findAll();
        
        return view('home', compact('todasVagas', 'numVagas', 'imobiliarias'));
    }

    public function imoveis()
    {
        $imoveis = $this->imoveisModel->getUltimosImoveisComEmpresa();  
        $tipoPropriedades = $this->tipoPropriedadesModel->findAll();
        $cidades = $this->imoveisModel->getCidades();
        $imobiliarias = $this->adminModel->where('id_grupo', 3)->findAll();
        
        return view('imoveis/index', compact('tipoPropriedades', 'imoveis', 'cidades', 'imobiliarias'));
    }

    public function detalhes(){
        $imoveis = $this->imoveisModel->getUltimosImoveisComEmpresa();  
        $tipoPropriedades = $this->tipoPropriedadesModel->findAll();
        $cidades = $this->imoveisModel->getCidades();
        
        return view('imoveis/detalhes', compact('tipoPropriedades', 'imoveis', 'cidades'));
    }
}
