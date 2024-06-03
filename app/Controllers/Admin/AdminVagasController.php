<?php

namespace App\Controllers\Admin;

use App\Models\Admin\AdminModel;
use App\Models\CategoriasModel;
use App\Models\VagasModel;
use App\Controllers\BaseController;
use App\Models\AtividadesExtracurricularesModel;
use App\Models\AuthIdentitiesModel;
use App\Models\CandidatoVagasModel;
use App\Models\CertificacoesModel;
use App\Models\EducacoesModel;
use App\Models\ExperienciasProfissionaisModel;
use App\Models\HabilidadesModel;
use App\Models\IdiomasModel;
use App\Models\InformacoesPessoaisModel;
use App\Models\ObjetivoProfissionalModel;
use App\Models\ProjetosModel;
use App\Models\PublicacoesModel;
use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Shield\Models\UserIdentityModel;

class AdminVagasController extends BaseController
{
    use ResponseTrait;  // Utilize o ResponseTrait para facilitar a resposta HTTP

    protected $usuarioModel;
    protected $informacoesPessoaisModel;
    protected $objetivoProfissionalModel;
    protected $educacoesModel;
    protected $experienciasProfissionaisModel;
    protected $habilidadesModel;
    protected $certificacoesModel;
    protected $idiomasModel;
    protected $projetosModel;
    protected $atividadesExtracurricularesModel;
    protected $publicacoesModel;
    protected $authIdentitiesModel;
    protected $candidatoVagasModel;
    protected $vagasModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->informacoesPessoaisModel = new InformacoesPessoaisModel();
        $this->objetivoProfissionalModel = new ObjetivoProfissionalModel();
        $this->educacoesModel = new EducacoesModel();
        $this->experienciasProfissionaisModel = new ExperienciasProfissionaisModel();
        $this->habilidadesModel = new HabilidadesModel();
        $this->certificacoesModel = new CertificacoesModel();
        $this->idiomasModel = new IdiomasModel();
        $this->projetosModel = new ProjetosModel();
        $this->atividadesExtracurricularesModel = new AtividadesExtracurricularesModel();
        $this->publicacoesModel = new PublicacoesModel();
        $this->authIdentitiesModel = new AuthIdentitiesModel();
        $this->candidatoVagasModel = new CandidatoVagasModel();
        $this->vagasModel = new VagasModel();
    }
    public function listarVagas()
    {
        $dados = [
            'title' => 'Vagas',
            'jsFiles' => [
                base_url('assets/admin/js/vagas.js')
            ]
        ];

        return view('admin/vagas/index', $dados);
    }

    public function cadastrarVaga()
    {
        $usuario_grupo = session()->get('grupo');

        // usuário empresa
        if ($usuario_grupo == 3) {
            return redirect()->back()->with('error', 'Você não tem permissão para essa funcionalidade.');
        }
        $adminModel = new AdminModel();
        $categoriasModel = new CategoriasModel();
        if ($this->request->getGetPost()) {

            $vaga = $this->request->getGetPost();

            $categoria = $categoriasModel->find($vaga['id_categoria'])->nome;

            $vaga['setor'] = $categoria;
            $vaga['salario'] = v2p($vaga['salario']);

            $vagaModel = new VagasModel();

            if (!$vagaModel->insertVaga($vaga)) {
                return redirect()->back()->with('error', 'Não Foi possível cadastrat a vaga.')->withInput();
            }

            return redirect()->to(base_url('admin/vagas/listar'))->with('success', 'Vaga cadastrada com sucesso!.');
        }

        $dados = [
            'empresas' => $adminModel->where('id_grupo', 2)->findAll(),
            'categorias' => $categoriasModel->findAll(),
            'title' => 'Cadastrar Vaga'
        ];

        return view('admin/vagas/cadastrar_editar', $dados);
    }

    public function excluirVaga($id)
    {
        $vagasModel = new VagasModel();

        // Verifica se a vaga realmente existe
        $vaga = $vagasModel->find($id);
        if (!$vaga) {
            return $this->failNotFound('Vaga não encontrada com ID: ' . $id);
        }

        // Verifica se o ID da empresa da vaga é igual ao ID da empresa na sessão
        if (session()->get('grupo') != 1) {
            $empresaId = session()->get('id');
            if ($vaga['empresa_id'] != $empresaId) {
                return $this->failForbidden('Você não tem permissão para excluir esta vaga.');
            }
        }

        // Tenta excluir a vaga
        if ($vagasModel->delete($id)) {
            return $this->respondDeleted(['success' => true, 'message' => 'Vaga deletada com sucesso!']);
        } else {
            return $this->failServerError('Erro ao tentar deletar a vaga');
        }
    }

    public function editarVaga($id)
    {
        $vagasModel = new VagasModel();
        $adminModel = new AdminModel();
        $categoriasModel = new CategoriasModel();
        // Verifica se a vaga realmente existe
        $vaga = $vagasModel->find($id);
        if (!$vaga) {
            return redirect()->to('/admin/vagas/listar')->with('error', 'Vaga não encontrada.');
        }

        if ($this->request->getMethod() === 'POST') {
            // Processar os dados do formulário
            $data = $this->request->getGetPost();

            $categoria = $categoriasModel->find($data['id_categoria'])->nome;

            $data['setor'] = $categoria;
            $data['salario'] = v2p($data['salario']);

            if ($vagasModel->update($id, $data)) {
                return redirect()->to('/admin/vagas/listar')->with('success', 'Vaga atualizada com sucesso.');
            } else {
                return redirect()->back()->with('error', 'Erro ao tentar atualizar a vaga.');
            }
        }

        // Mostrar o formulário com os dados existentes
        return view('admin/vagas/cadastrar_editar', [
            'empresas' => $adminModel->where('id_grupo', 2)->findAll(),
            'categorias' => $categoriasModel->findAll(),
            'title' => 'Alterar Vaga',
            'vaga' => $vaga
        ]);
    }

    public function candidatos($id)
    {
        $candidatos = $this->candidatoVagasModel->getCandidatosPorVaga($id);
        return $this->response->setJSON($candidatos);
    }

    public function enviarEmail()
    {
        $candidatos = $this->request->getPost('candidatos');
        $vagaId = $this->request->getPost('vaga_id');

        if (empty($candidatos) || empty($vagaId)) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Nenhum candidato selecionado ou vaga não especificada.']);
        }
        $vagaCompleta = $this->vagasModel->getVagaComEmpresa($vagaId);
        // Informações da empresa (substitua com dados reais)
        $empresaNome = $vagaCompleta->empresa_nome;
        $empresaEndereco = $vagaCompleta->empresa_endereco;
        $empresaEmail = $vagaCompleta->empresa_email;
        $empresaTelefone =$vagaCompleta->empresa_telefone;
        $emailSuporte = $vagaCompleta->empresa_email;

        foreach ($candidatos as $candidatoId) {
            // Alterar o status do candidato para "selecionado"
            $this->candidatoVagasModel->set(['selecionado' => 1])
                ->where('id_usuario', $candidatoId)
                ->where('id_vaga', $vagaId)
                ->update();

            // Enviar email para o candidato
            $usuario = $this->usuarioModel->find($candidatoId);
            $authIdentitiesModel = new UserIdentityModel();
            $authIdentity = $authIdentitiesModel->where('user_id', $candidatoId)->first();

            if ($authIdentity) {
                $emailService = \Config\Services::email();
                $emailService->setTo($authIdentity->secret);
                $emailService->setSubject('Você foi selecionado para uma entrevista!');

                // Template de email com substituição de variáveis
                $emailMessage = view('emails/candidato_selecionado', [
                    'nomeCandidato' => $usuario->username,
                    'empresaNome' => $empresaNome,
                    'empresaEndereco' => $empresaEndereco,
                    'empresaEmail' => $empresaEmail,
                    'empresaTelefone' => $empresaTelefone,
                    'emailSuporte' => $emailSuporte,
                ]);

                $emailService->setMessage($emailMessage);

                if (!$emailService->send()) {
                    // Registro do erro de envio do email
                    log_message('error', "Erro ao enviar email para o candidato ID: {$candidatoId}");
                }
            }
        }

        return $this->response->setStatusCode(200)->setJSON(['message' => 'Emails enviados com sucesso!']);
    }


    public function curriculo($id)
    {
        if (!isset(auth()->user()->id)) {
            return redirect()->to(base_url());
        }

        // Buscar informações do usuário
        $usuario = $this->usuarioModel->find($id);
        $informacoesPessoais = $this->informacoesPessoaisModel->where('usuario_id', $id)->first();
        $objetivoProfissional = $this->objetivoProfissionalModel->where('usuario_id', $id)->first();
        $educacoes = $this->educacoesModel->where('usuario_id', $id)->findAll();
        $experienciasProfissionais = $this->experienciasProfissionaisModel->where('usuario_id', $id)->findAll();
        $habilidades = $this->habilidadesModel->where('usuario_id', $id)->findAll();
        $certificacoes = $this->certificacoesModel->where('usuario_id', $id)->findAll();
        $idiomas = $this->idiomasModel->where('usuario_id', $id)->findAll();
        $projetos = $this->projetosModel->where('usuario_id', $id)->findAll();
        $atividadesExtracurriculares = $this->atividadesExtracurricularesModel->where('usuario_id', $id)->findAll();
        $publicacoes = $this->publicacoesModel->where('usuario_id', $id)->findAll();

        // Buscar informações de autenticação (Shield)
        $authIdentitiesModel = new UserIdentityModel;
        $authIdentities = $authIdentitiesModel->where('user_id', $id)->first();

        $data = [
            'usuario' => $usuario,
            'informacoesPessoais' => $informacoesPessoais,
            'objetivoProfissional' => $objetivoProfissional,
            'educacoes' => $educacoes,
            'experienciasProfissionais' => $experienciasProfissionais,
            'habilidades' => $habilidades,
            'certificacoes' => $certificacoes,
            'idiomas' => $idiomas,
            'projetos' => $projetos,
            'atividadesExtracurriculares' => $atividadesExtracurriculares,
            'publicacoes' => $publicacoes,
            'authIdentities' => $authIdentities,
        ];

        return $this->response->setJSON($data);
    }
}
