<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Admin\GrupoUsuarioModel;
use App\Models\AuthIdentitiesModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\UserModel;

class AdminController extends BaseController
{
    protected $configEmail;
    protected $email;
    public function __construct()
    {
        $this->email = \Config\Services::email();

        $this->configEmail = [
            'protocol' => 'smtp',
            'SMTPHost' => 'mail.soulclinic.app.br',
            'SMTPUser' => 'noreplay@soulclinic.app.br',
            'SMTPPass' => '123qweasd',
            'SMTPPort' => 587,
            'SMTPCrypto' => 'tls',
            'charset' => 'UTF-8',
            'mailType' => 'html',  // Se você estiver enviando HTML
            'newline' => "\r\n",   // Pode ser necessário dependendo do servidor SMTP
        ];
        $this->email->initialize($this->configEmail);
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

        $this->email->setFrom('noreplay@soulclinic.app.br', 'Não Responda');
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
