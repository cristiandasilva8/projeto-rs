<?php

namespace App\Controllers\Vagas;

use App\Controllers\BaseController;
use App\Models\CandidatoVagasModel;
use App\Models\CategoriasModel;
use App\Models\ImoveisModel;
use App\Models\VagasModel;
use CodeIgniter\HTTP\ResponseInterface;

class VagasController extends BaseController
{

    public function listarVagas()
    {
        $vagaModel = new VagasModel();
        $data = $vagaModel->getVagasComCandidatos();

        return $this->response->setJSON([
            "draw" => intval($this->request->getPost('draw')),
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        ]);
    }


    public function detalhes($id)
    {
        $vagaModel = new VagasModel();
        $imoveisModel = new ImoveisModel();
       
        $detalhes = $vagaModel->getVagaComEmpresa($id);
        $imoveis = $imoveisModel->buscarImoveisProximos($detalhes->latitude, $detalhes->longitude);
        return view('vagas/detalhes', compact('detalhes', 'imoveis'));
    }

    public function candidatar($id)
    {
        $candidatar = new CandidatoVagasModel();

        $userId = auth()->user()->id;

        // Verifica se o usuário já se candidatou a esta vaga
        $alreadyApplied = $candidatar->where('id_usuario', $userId)
            ->where('id_vaga', $id)
            ->first();

        if ($alreadyApplied) {
            return redirect()->to(base_url("vagas/detalhes/$id"))->with('error', 'Você já se candidatou a esta vaga.');
        }

        $data = [
            'id_usuario' => $userId,
            'id_vaga' => $id,
        ];

        $candidatar->save((object)$data);


        // Configura o serviço de e-mail
        // $email = \Config\Services::email();

        // $email->setFrom('seu-email@example.com', 'Nome do Site');
        // $email->setTo($empresaEmail);

        // $email->setSubject('Novo candidato para a vaga: ' . $vaga->titulo);
        // $email->setMessage(view('emails/candidatura', ['user' => $user, 'vaga' => $vaga]));

        // if ($email->send()) {
        //     return redirect()->to(base_url("vagas/detalhes/$id"))->with('success', 'Você se candidatou à vaga e a empresa foi notificada.');
        // } else {
        //     return redirect()->to(base_url("vagas/detalhes/$id"))->with('error', 'Falha ao enviar e-mail para a empresa.');
        // }



        return redirect()->to(base_url("vagas/detalhes/$id"))->with('success', 'Você se candidatou à vaga');
    }

    public function procurarVagas()
    {
        $vaga = new VagasModel();
        $categoriaModel = new CategoriasModel(); // Assumindo que o nome do model é CategoriaModel

        // Obter todas as categorias
        $categorias = $categoriaModel->findAll();

        $termoDeBusca = $this->request->getGetPost('termo');
        $salarioMin = $this->request->getGetPost('salario_min');
        $salarioMax = $this->request->getGetPost('salario_max');
        $categoriaId = $this->request->getGetPost('id_categoria');
        $tipoVaga = $this->request->getGetPost('tipo_vaga');

        // Filtro por nome parcial
        if (!empty($termoDeBusca)) {
            $vaga->like('nome', $termoDeBusca);
        }

        // Filtro por intervalo de salário
        if (!empty($salarioMin)) {
            $vaga->where('salario >=', $salarioMin);
        }
        if (!empty($salarioMax)) {
            $vaga->where('salario <=', $salarioMax);
        }

        // Filtro por categoria
        if (!empty($categoriaId)) {
            $vaga->where('id_categoria', $categoriaId);
        }

        // Filtro por tipo de vaga
        if (!empty($tipoVaga)) {
            $vaga->where('tipo', strtolower($tipoVaga));
        }

        $vagas = $vaga
        ->select('vagas.*, admin_usuarios.nome as empresa_nome, admin_usuarios.imagem as empresa_imagem')
        ->join('admin_usuarios', 'vagas.empresa_id = admin_usuarios.id')
        ->where('vagas.salario IS NOT NULL AND vagas.salario != ""')
        ->where('vagas.cidade IS NOT NULL AND vagas.cidade != ""')
        ->where('vagas.estado IS NOT NULL AND vagas.estado != ""')
        ->where('vagas.deleted_at', null)
        ->findAll();

        // Verifica se a requisição é AJAX
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($vagas);
        } else {
            return view('vagas/procurar_vagas', compact('vagas', 'categorias'));
        }
    }
}
