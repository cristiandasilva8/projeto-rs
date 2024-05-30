<?php

namespace App\Controllers\Imoveis;

use App\Controllers\BaseController;
use App\Models\ImoveisModel;

class ImoveisController extends BaseController
{

    public function listarImoveis()
    {
        $imoveisModel = new ImoveisModel();
        $data = $imoveisModel->getImoveis();

        return $this->response->setJSON([
            "draw" => intval($this->request->getPost('draw')),
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        ]);
    }

    public function detalhes($id)
    {
        $imoveisModel = new ImoveisModel();

        $detalhes = $imoveisModel->find($id);

        //var_dump($detalhes);

        return view('vagas/detalhes', compact('detalhes'));
    }


    public function procurarImoveis()
    {
        $imoveisModel = new ImoveisModel();
   
        $termoDeBusca = $this->request->getGetPost('termo');
        $precoMin = $this->request->getGetPost('preco_min');
        $precoMax = $this->request->getGetPost('preco_max');


        // Filtro por nome parcial
        if (!empty($termoDeBusca)) {
            $imoveisModel->like('nome', $termoDeBusca);
        }

        // Filtro por intervalo de salário
        if (!empty($precoMin)) {
            $imoveisModel->where('preco >=', $precoMin);
        }
        if (!empty($precoMax)) {
            $imoveisModel->where('preco <=', $precoMax);
        }

        $imoveis = $imoveisModel->findAll();

        // Verifica se a requisição é AJAX
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($imoveis);
        } else {
            return view('vagas/procurar_vagas', compact('vagas', 'categorias'));
        }
    }
}
