<?php

namespace App\Controllers\Admin;

use App\Models\Admin\AdminModel;
use App\Models\CategoriasModel;
use App\Models\VagasModel;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;


class AdminVagasController extends BaseController
{
    use ResponseTrait;  // Utilize o ResponseTrait para facilitar a resposta HTTP
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
}
