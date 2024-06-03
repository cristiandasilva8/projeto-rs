<?php

namespace App\Controllers\Imoveis;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\ImoveisModel;
use App\Models\TipoPropriedadeModel;

class ImoveisController extends BaseController
{
    protected $vagasModel;
    protected $adminModel;
    protected $imoveisModel;
    protected $tipoPropriedadesModel;
    
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->imoveisModel = new ImoveisModel();
        $this->tipoPropriedadesModel = new TipoPropriedadeModel();
    }

    public function listarImoveis()
    {
        $data = $this->imoveisModel->getImoveis();

        return $this->response->setJSON([
            "draw" => intval($this->request->getPost('draw')),
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        ]);
    }

    public function detalhes($id)
    {
        $detalhes = $this->imoveisModel->getImovelComEmpresa($id);
        return view('imoveis/detalhes', compact('detalhes'));
    }

    public function procurar()
    {
        $imobiliarias = $this->adminModel->where('id_grupo', 3)->findAll();
        $imoveis = $this->imoveisModel->getUltimosImoveisComEmpresa();  
        $tipoPropriedades = $this->tipoPropriedadesModel->findAll();
        $cidades = $this->imoveisModel->getCidades();
        $imobiliarias = $this->adminModel->where('id_grupo', 3)->findAll();
        
        return view('imoveis/procurar_imoveis', compact('tipoPropriedades', 'imoveis', 'cidades', 'imobiliarias'));
    }

    public function procurarImoveis()
    {
        $imoveis = $this->imoveisModel->findAllComImobiliaria($this->request->getGetPost());
        // Verifica se a requisição é AJAX
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($imoveis);
        } else {
            return view('imoveis/procurar_imoveis', compact('imoveis'));
        }
    }
}
