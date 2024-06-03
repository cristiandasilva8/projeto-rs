<?php

namespace App\Controllers\Vagas;

use App\Controllers\BaseController;
use App\Models\AtividadesExtracurricularesModel;
use App\Models\AuthIdentitiesModel;
use App\Models\CandidatoVagasModel;
use App\Models\CategoriasModel;
use App\Models\CertificacoesModel;
use App\Models\EducacoesModel;
use App\Models\ExperienciasProfissionaisModel;
use App\Models\HabilidadesModel;
use App\Models\IdiomasModel;
use App\Models\ImoveisModel;
use App\Models\InformacoesPessoaisModel;
use App\Models\ObjetivoProfissionalModel;
use App\Models\ProjetosModel;
use App\Models\PublicacoesModel;
use App\Models\UsuarioModel;
use App\Models\VagasModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\UserIdentityModel;

class VagasController extends BaseController
{

    protected $vagaModel;
    protected $imoveisModel;
    protected $candidatoVagasModel;
    protected $usuarioModel;
    protected $informacoesPessoaisModel;
    protected $authIdentitiesModel;

    public function __construct()
    {
        $this->vagaModel = new VagasModel();
        $this->imoveisModel = new ImoveisModel();
        $this->candidatoVagasModel = new CandidatoVagasModel();
        $this->usuarioModel = new UsuarioModel();
        $this->informacoesPessoaisModel = new InformacoesPessoaisModel();
        $this->authIdentitiesModel = new AuthIdentitiesModel();
    }
    

    public function listarVagas()
    {

        $data = $this->vagaModel->getVagasComCandidatos();

        return $this->response->setJSON([
            "draw" => intval($this->request->getPost('draw')),
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        ]);
    }


    public function detalhes($id)
    {
       
        $detalhes = $this->vagaModel->getVagaComEmpresa($id);
        $imoveis = $this->imoveisModel->buscarImoveisProximos($detalhes->latitude, $detalhes->longitude);
        return view('vagas/detalhes', compact('detalhes', 'imoveis'));
    }

    public function candidatar($id)
    {
        if (!isset(auth()->user()->id)) {
            return redirect()->to(base_url("vagas/detalhes/$id"))->with('error', 'Você não está logado para se candidatar a vaga!');
        }
        $userId = auth()->user()->id;

        // Verifica se o usuário já se candidatou a esta vaga
        $alreadyApplied = $this->candidatoVagasModel->where('id_usuario', $userId)
            ->where('id_vaga', $id)
            ->first();

        if ($alreadyApplied) {
            return redirect()->to(base_url("vagas/detalhes/$id"))->with('error', 'Você já se candidatou a esta vaga.');
        }

        $data = [
            'id_usuario' => $userId,
            'id_vaga' => $id,
        ];

        if(!$this->candidatoVagasModel->save((object)$data)){
            return redirect()->to(base_url("vagas/detalhes/$id"))->with('error', 'Ocorreu um erro no momento de se candidatar a vaga, entre em contato com o suporte.');
        }

        $vaga  = $this->vagaModel->getVagaComEmpresa($id);
        $candidato = $this->dadosCandidato();


        // Configura o serviço de e-mail
        $email = \Config\Services::email();

        $email->setFrom(ADMIN_EMAIL, SITE_NAME);
        $email->setTo($vaga->empresa_email);

        $email->setSubject('Novo candidato para a vaga: ' . $vaga->nome);
        $email->setMessage(view('emails/candidatura', ['usuario' => (object)$candidato, 'vaga' => $vaga]));

        if (!$email->send()) {
            return redirect()->to(base_url("vagas/detalhes/$id"))->with('error', 'Falha ao enviar e-mail para a empresa.');
        } 

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

    private function dadosCandidato()
    {
        $id = auth()->user()->id;

        // Buscar informações do usuário
        $usuario = $this->usuarioModel->find($id);
        $informacoesPessoais = $this->informacoesPessoaisModel->where('usuario_id', $id)->first();
  
        // Buscar informações de autenticação (Shield)
        $authIdentitiesModel = new UserIdentityModel;
        $authIdentities = $authIdentitiesModel->where('user_id', $id)->first();

        return [
            'usuario' => $usuario,
            'informacoesPessoais' => $informacoesPessoais,
            'authIdentities' => $authIdentities,

        ];
    }
}
