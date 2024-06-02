<?php

namespace App\Controllers\Usuarios;

use App\Controllers\BaseController;
use App\Models\AtividadesExtracurricularesModel;
use App\Models\AuthIdentitiesModel;
use App\Models\CertificacoesModel;
use App\Models\EducacoesModel;
use App\Models\ExperienciasProfissionaisModel;
use App\Models\FamiliasModel;
use App\Models\HabilidadesModel;
use App\Models\IdiomasModel;
use App\Models\InformacoesPessoaisModel;
use App\Models\ObjetivoProfissionalModel;
use App\Models\ProjetosModel;
use App\Models\PublicacoesModel;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserIdentityModel;

class UserController extends BaseController
{
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
    }
    public function index()
    {
        //
    }

    public function curriculo()
    {
        $id = auth()->user()->id;

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

        return [
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
    }

    public function perfil()
    {
        if (!isset(auth()->user()->id)) {
            return redirect()->to(base_url());
        }

        $id = auth()->user()->id;

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

        return view('usuarios/perfil', [
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

        ]);
    }

    public function adicionarInformacao($tipo)
    {
        $data = $this->request->getPost();

        switch ($tipo) {
            case 'educacao':
                $model = $this->educacoesModel;
                break;
            case 'experiencia':
                $model = $this->experienciasProfissionaisModel;
                break;
            case 'habilidade':
                $model = $this->habilidadesModel;
                break;
            case 'certificacao':
                $model = $this->certificacoesModel;
                break;
            case 'idioma':
                $model = $this->idiomasModel;
                break;
            case 'projeto':
                $model = $this->projetosModel;
                break;
            case 'atividade':
                $model = $this->atividadesExtracurricularesModel;
                break;
            case 'publicacao':
                $model = $this->publicacoesModel;
                break;
            default:
                return $this->response->setStatusCode(400, 'Tipo inválido');
        }
        $data['usuario_id'] = auth()->user()->id;

        if ($model->insert($data)) {
            $insertedData = $model->find($model->insertID());
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Informação adicionada com sucesso!', 'data' => $insertedData]);
        } else {
            return $this->response->setStatusCode(500, 'Erro ao adicionar informação');
        }
    }

    public function excluirInformacao($tipo, $id)
    {
        
        switch ($tipo) {
            case 'educacao':
                $model = $this->educacoesModel;
                break;
            case 'experiencia':
                $model = $this->experienciasProfissionaisModel;
                break;
            case 'habilidade':
                $model = $this->habilidadesModel;
                break;
            case 'certificacao':
                $model = $this->certificacoesModel;
                break;
            case 'idioma':
                $model = $this->idiomasModel;
                break;
            case 'projeto':
                $model = $this->projetosModel;
                break;
            case 'atividade':
                $model = $this->atividadesExtracurricularesModel;
                break;
            case 'publicacao':
                $model = $this->publicacoesModel;
                break;
            default:
                return $this->response->setStatusCode(400, 'Tipo inválido');
        }

        $model->delete($id);
        return $this->response->setStatusCode(200)->setJSON(['message' => 'Informação excluída com sucesso!']);
    }


    public function salvarInformacoesPessoais()
    {
        $data = $this->request->getPost();

        // Adicione o ID do usuário aos dados
        $data['usuario_id'] = auth()->user()->id;

        $usuarioData = [
            'id' => $data['usuario_id'],
            'username' => $data['nome'],
            'email' => $data['email']
        ];

        $informacoesPessoaisData = [
            'usuario_id' => $data['usuario_id'],
            'telefone' => $data['telefone'],
            'whatsapp' => $data['whatsapp'],
            'endereco' => $data['endereco'],
            'linkedin' => $data['linkedin'],
            'instagram' => $data['instagram'],
            'facebook' => $data['facebook'],
        ];

        // Atualiza a senha se fornecida

        if (!empty($data['senha'])) {
            if ($data['senha'] === $data['confirmar_senha']) {
                $secret2 = password_hash($data['senha'], PASSWORD_DEFAULT);
                if (!$this->authIdentitiesModel->updatePassword(auth()->user()->id, ['secret2' => $secret2])) {
                    return $this->response->setStatusCode(400)->setJSON(['message' => 'Falha ao atualizar a senha.']);
                }
            } else {
                return $this->response->setStatusCode(400)->setJSON(['message' => 'As senhas não são iguais.']);
            }
        }

        if ($fotoPerfil = $this->request->getFile('foto_perfil')) {
            if ($fotoPerfil->isValid() && !$fotoPerfil->hasMoved()) {
                $diretorio = 'uploads/usuarios/foto_curriculo/' . $data['usuario_id'];

                // Verifica se o diretório existe, se não, cria
                if (!is_dir($diretorio)) {
                    mkdir($diretorio, 0777, true);
                }

                // Verifica se já existe uma imagem de perfil e a exclui
                $existingInfo = $this->informacoesPessoaisModel->where('usuario_id', $data['usuario_id'])->first();
                if ($existingInfo && !empty($existingInfo->foto_perfil) && file_exists($existingInfo->foto_perfil)) {
                    unlink($existingInfo->foto_perfil);
                }

                // Move a nova imagem
                $newName = $fotoPerfil->getRandomName();
                $fotoPerfil->move($diretorio, $newName);

                // Redimensionar a imagem
                \Config\Services::image()
                    ->withFile($diretorio . '/' . $newName)
                    ->resize(80, 80, true, 'height')
                    ->save($diretorio . '/' . $newName);

                $informacoesPessoaisData['foto_perfil'] = $diretorio . '/' . $newName;
            }
        }

        // Atualiza ou cria as informações do usuário
        $this->usuarioModel->save($usuarioData);

        // Verifica se já existe uma entrada de informações pessoais para o usuário
        $existingInfo = $this->informacoesPessoaisModel->where('usuario_id', $data['usuario_id'])->first();

        if ($existingInfo) {
            // Atualiza a entrada existente
            $informacoesPessoaisData['id'] = $existingInfo->id;
        }

        // Salva as informações pessoais (inserção ou atualização)
        $this->informacoesPessoaisModel->save($informacoesPessoaisData);

        return $this->response->setStatusCode(200)->setJSON(['message' => 'Informações pessoais salvas com sucesso!', 'foto_perfil' => $informacoesPessoaisData['foto_perfil'] ?? null]);
    }


    public function salvarObjetivoProfissional()
    {
        $data = $this->request->getPost();

        // Adicione o ID do usuário aos dados
        $data['usuario_id'] = auth()->user()->id;

        $objetivoData = [
            'usuario_id' => $data['usuario_id'],
            'objetivo' => $data['objetivo']
        ];

        $this->objetivoProfissionalModel->save($objetivoData);

        return $this->response->setStatusCode(200)->setJSON(['message' => 'Objetivo profissional salvo com sucesso!']);
    }
}
