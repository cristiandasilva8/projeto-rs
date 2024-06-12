<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Admin\GrupoUsuarioModel;
use App\Models\AuthIdentitiesModel;
use App\Models\CandidatoVagasModel;

use App\Services\ImageService;


class AdminController extends BaseController
{
   

    protected $configEmail;
    protected $email;
    public function __construct()
    {
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        return view('admin/index');
    }
    public function login()
    {

        return view('admin/login');
    }

    public function logout()
    {
        $session = session();

        $dados_sessao = [
            'id' => "",
            'nome_usuario' => "",
            'email' => "",
            'isLoggedIn' => FALSE,
            'isVerified' => FALSE,
        ];

        $session->set($dados_sessao);
        return redirect()->to(base_url('admin/login'))->with('success', 'Você saiu do sistema com sucesso.');
    }

    public function registrarUsuario()
    {

        if ($this->request->getGetPost()) {

            $email = $this->request->getGetPost('email');
            $senha = $this->request->getGetPost('senha');
            $confirma_senha = $this->request->getGetPost('confirma_senha');

            // Verifica se as senhas coincidem
            if ($senha !== $confirma_senha) {
                // As senhas não coincidem
                return redirect()->to(base_url('admin/registrar'))->with('error', 'As senhas não coincidem.')->withInput();
            }

            // Verifica se o email já existe nas tabelas 'admin_usuario' e 'users'
            $usuarioModel = new AdminModel();

            $adminExists = $usuarioModel->where('email', $email)->first();
            $authIdentitiesModel = new AuthIdentitiesModel();


            if ($adminExists || $authIdentitiesModel->identityExists($email)) {
                // Email já cadastrado, retorna para a página de registro com mensagem de erro
                return redirect()->to(base_url('admin/registrar'))->with('error', 'Email já está em uso.')->withInput();
            }

            $data = [
                'nome' => $this->request->getGetPost('nome'),
                'email' => $email,
                'senha' => $this->request->getGetPost('senha'), // A senha será hasheada no modelo
                'id_grupo' => $this->request->getGetPost('id_grupo'),
            ];

            $inserted = $usuarioModel->insertUser($data);

            if ($inserted) {
                $codigoVerificacao = $usuarioModel->where('id', $inserted)->get()->getRow()->codigo_verificacao;

                if (!$this->enviarEmailVerificacao($data['email'], $codigoVerificacao)) {
                    return redirect()->to(base_url('admin/login'))->with('error', 'Falha ao enviar o e-mail de verificação.')->withInput();
                }

                return redirect()->to(base_url('admin/verificar'))->with('success', 'Registro bem-sucedido! Verifique seu e-mail para ativar sua conta.'); // Direciona para a página de verificação
            }

            return redirect()->to(base_url('admin'));
        }

        $grouposModel = new GrupoUsuarioModel();

        $grupos = $grouposModel->where('id > 1')->findAll();

        return view('admin/registrar', compact('grupos'));
    }

    public function verificar()
    {

        if ($this->request->getGetPost()) {
            $codigoVerificacao = $this->request->getVar('verification_code');
            $usuarioAdminModel = new AdminModel();

            if ($usuarioAdminModel->verifyUser($codigoVerificacao)) {
                // Atualiza a sessão para indicar que o usuário está verificado
                session()->set('isVerified', true);
                return redirect()->to(base_url('admin'))->with('success', 'Sua conta foi verificada com sucesso!');
                // Direciona para o dashboard se verificado
            } else {
                return redirect()->back()->with('error', 'Código inválido.');
            }
        }

        return view('admin/verificar');
    }

    public function checkLogin()
    {

        $session = session();
        $adminModel = new AdminModel();

        $email = $this->request->getGetPost('email');
        $senha = $this->request->getGetPost('senha');

        $data = $adminModel->where('email', $email)->first();

        if ($data) {
            $senhaUsuarioAdmin = $data->senha;

            $autenticarSenha = password_verify($senha, $senhaUsuarioAdmin);

            if ($autenticarSenha) {
                $dados_sessao = [
                    'id' => $data->id,
                    'nome_usuario' => $data->nome,
                    'grupo' => $data->id_grupo,
                    'email' => $data->email,
                    'isLoggedIn' => TRUE,
                    'isVerified' => ($data->verificado == 1) ? TRUE : FALSE,
                ];
                $session->set($dados_sessao);
                return redirect()->to(base_url('admin'))->with('success', 'Login bem-sucedido!');
            } else {
                return redirect()->to(base_url('admin/login'))->with('error', 'Usuário ou senha inválidos');
            }
        } else {
            $session->setFlashdata('msg', 'E-mail não existe na base de dados');
            return redirect()->to(base_url('admin/login'));
        }


        if (!$data) {
            // E-mail não encontrado
            return redirect()->to(base_url('admin/login'))->with('error', 'E-mail não existe na base de dados');
        }
    }

    public function recuperarSenha()
    {
        if ($this->request->getGetPost()) {
            $email = $this->request->getPost('email');


            // Verifica se o email já existe nas tabelas 'admin_usuario' e 'users'
            $usuarioModel = new AdminModel();

            $usuario = $usuarioModel->where('email', $email)->first();
            $authIdentitiesModel = new AuthIdentitiesModel();

            $usuariotrabalhador = $authIdentitiesModel->where('secret', $email)->first();

            // Determina qual usuário está sendo recuperado e realiza a atualização de senha apropriada
            if ($usuario) {
                $novaSenha = $this->gerarSenhaAleatoria();
                $usuarioModel->update($usuario->id, [
                    'senha' => password_hash($novaSenha, PASSWORD_DEFAULT)
                ]);
                $emailEnviado = $this->enviarEmailComNovaSenha($email, $novaSenha);
            } elseif ($usuariotrabalhador) {
                return redirect()->to(base_url('login/magic-link'))->with('error', 'Esse e-mail é um email de um usuário do tipo Trabalhador, faça o reset da sua senha por esse formulário.');
            } else {
                // Nenhum usuário encontrado
                return redirect()->back()->with('error', 'Nenhum usuário encontrado com esse email.');
            }

            // Verifica se o email foi enviado com sucesso
            if ($emailEnviado) {
                // E-mail enviado com sucesso
                return redirect()->to(base_url('admin/login'))->with('success', 'Uma nova senha foi enviada para o seu email.');
            } else {
                // Falha ao enviar o e-mail
                return redirect()->back()->with('error', 'Falha ao enviar a senha por email.');
            }
        }


        return view('admin/recuperar_senha');
    }

    public function candidatos($vagaId)
    {
        $model = new CandidatoVagasModel();
        $candidatos = $model->getCandidatosPorVaga($vagaId);

        if (empty($candidatos)) {
            return $this->response->setJSON([]);  // Retorna um array vazio se não houver candidatos
        }

        return $this->response->setJSON($candidatos);
    }

    
    public function perfil()
    {
        $session = session();
        $userModel = new AdminModel();

        // Checa se a requisição é POST para processar a atualização do perfil
        if ($this->request->getMethod() === 'POST') {

            // Coleta dados do formulário, exceto a senha
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'endereco_completo' => $this->request->getPost('endereco_completo'),
                'telefone' => $this->request->getPost('telefone'),
                'celular' => $this->request->getPost('celular'),
                'cpf_cnpj' => $this->request->getPost('cpf_cnpj'),
                'creci' => ($this->request->getPost('creci')) ? $this->request->getPost('creci') : NULL,
                'descricao' => ($this->request->getPost('descricao')) ? $this->request->getPost('descricao') : NULL,
                'nome_responsavel' => ($this->request->getPost('nome_responsavel')) ? $this->request->getPost('nome_responsavel') : NULL,
            ];

            // Processamento de upload de imagem
            $imgCarregada = $this->upload();
            if($imgCarregada != ''){
                $data['imagem'] = $imgCarregada;
            }
                
            // Adiciona a senha ao array de dados apenas se ela for fornecida
            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $data['senha'] = password_hash($password, PASSWORD_DEFAULT);
            }

            if (!empty($password)) {
                $validationRules['senha'] = 'required|min_length[8]';
            }

            $id = $session->get('id'); // Supõe-se que o ID do usuário está armazenado na sessão
            if ($userModel->update($id, $data)) {
                return redirect()->to('admin/usuario/perfil')->with('success', 'Perfil atualizado com sucesso.');
            } else {
                return redirect()->to('admin/usuario/perfil')->with('error', 'Erro ao atualizar o perfil.');
            }
        }

        // Se não for POST, renderiza o formulário com dados do usuário atual
        $userData = $userModel->find($session->get('id'));

        return view('admin/usuarios/perfil', ['userData' => $userData]);
    }

    private function upload()
    {
        $imageService = new ImageService();
        $img = $this->request->getFile('imagem');

        try {
            $imagePath = $imageService->uploadAndResizeImage($img);
            // Salve o caminho da imagem no banco de dados ou faça outras operações necessárias
            // $data['imagem'] = $imagePath;
            return $imagePath;
        } catch (\RuntimeException $e) {
            return $this->response->setStatusCode(400, $e->getMessage());
        }
    }

    private function gerarSenhaAleatoria($length = 8)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $caracteresLength = strlen($caracteres);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $caracteres[rand(0, $caracteresLength - 1)];
        }
        return $randomString;
    }

    private function enviarEmailVerificacao($emailDestinatario, $codigoVerificacao)
    {
        // Configure as informações do e-mail
        $this->email->setFrom('noreplay@soulclinic.app.br', 'Não Responda');

        $this->email->setTo($emailDestinatario);
        $this->email->setSubject('Verifique seu cadastro');

        $this->email->setMessage("Olá, use o seguinte código de verificação para ativar sua conta: <strong>$codigoVerificacao</strong>");

        if ($this->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function enviarEmailComNovaSenha($email, $novaSenha)
    {

        $this->email->setFrom(ADMIN_EMAIL, SITE_NAME);
        $this->email->setTo($email);
        $this->email->setSubject('Recuperação de Senha');
        $this->email->setMessage('Sua nova senha é: ' . $novaSenha);

        if ($this->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
