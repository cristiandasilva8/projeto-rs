<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\ImoveisModel;
use App\Models\ImovelImagemModel;
use App\Models\TipoPropriedadeModel;
use App\Services\ImageService;


class AdminImoveisController extends BaseController
{
    protected $imageService;
    protected $tipoPropriedadeModel;
    public function __construct()
    {
        $this->imageService = new ImageService();
        $this->tipoPropriedadeModel = new TipoPropriedadeModel();
    }

    public function listarImoveis()
    {
        $dados = [
            'title' => 'Imoveis',
            'jsFiles' => [
                base_url('assets/admin/js/imoveis.js')
            ]
        ];

        return view('admin/imoveis/index', $dados);
    }

    public function cadastrarImovel()
    {
        $usuario_grupo = session()->get('grupo');

        // usuário empresa
        if ($usuario_grupo == 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para essa funcionalidade.');
        }
        $adminModel = new AdminModel();
        

        if ($this->request->getGetPost()) {

            $imovel = $this->request->getGetPost();
           
            // Tratamento da foto destaque
            $imgCarregada = $this->upload();
            if ($imgCarregada != '') {
                $imovel['foto_destaque'] = $imgCarregada;
            }

            $imovelModel = new ImoveisModel();

            if (!$imovelModel->insertImovel($imovel)) {
                return redirect()->back()->with('error', 'Não Foi possível cadastrat a vaga.')->withInput();
            }
            return redirect()->back()->with('success', 'Imóvel cadastrada com sucesso!');
        }

        $dados = [
            'empresas' => $adminModel->where('id_grupo', 3)->findAll(),
            'tipo_propriedades' => $this->tipoPropriedadeModel->findAll(),
            'title' => 'Cadastrar imóvel',
            'jsFiles' => [
                base_url('assets/admin/js/imoveis.js')
            ]
        ];

        return view('admin/imoveis/cadastrar_editar', $dados);
    }

    public function editarImovel($id)
    {
        $imoveisModel = new ImoveisModel();
        $adminModel = new AdminModel();
        $imovelImagemModel = new ImovelImagemModel();
        // Verifica se a vaga realmente existe
        $imovel = $imoveisModel->find($id);

        if (!$imovel) {
            return redirect()->to('/admin/imovel/listar')->with('error', 'Vaga não encontrada.');
        }

        if ($this->request->getMethod() === 'POST') {
            // Processar os dados do formulário
            $data = $this->request->getPost();

            // Tratamento da foto destaque
            $imgCarregada = $this->upload();
            if ($imgCarregada != '') {
                // Verifica se existe uma imagem carregada e faz o unlink
                if (!empty($imovel->foto_destaque) && file_exists(ROOTPATH . 'public' . $imovel->foto_destaque)) {
                    unlink(ROOTPATH . 'public' . $imovel->foto_destaque);
                }
                $data['foto_destaque'] = $imgCarregada;
            }

            if ($imoveisModel->update($id, $data)) {
                return redirect()->back()->with('success', 'Imóvel atualizado com sucesso.');
            } else {
                return redirect()->back()->with('error', 'Erro ao tentar atualizar o imóvel.');
            }
        }

        $imovelImagem = $imovelImagemModel->where('id_imovel', $id)->findAll();

        // Mostrar o formulário com os dados existentes
        return view('admin/imoveis/cadastrar_editar', [
            'empresas' => $adminModel->where('id_grupo', 3)->findAll(),
            'imagens' => $imovelImagem,
            'tipo_propriedades' => $this->tipoPropriedadeModel->findAll(),
            'uploadUrl' => base_url("admin/imovel/uploadImages/{$id}"),
            'deleteUploadUrl' => base_url("admin/imovel/deleteImage/"),
            'title' => 'Alterar imóvel',
            'imovel' => $imovel,
            'jsFiles' => [
                base_url('assets/admin/js/imoveis.js')
            ]
        ]);
    }

    public function excluirImovel($id)
    {
        $imoveisModel = new ImoveisModel();
        $imovelImagemModel = new ImovelImagemModel();
 
        // Verifica se o imóvel realmente existe
        $imovel = $imoveisModel->find($id);
       
        if (!$imovel) {
            return $this->response->setJSON(['error' => 'Imóvel não encontrado.'], 404);
        }

        // Apaga a foto destaque do imóvel, se existir
        if (!empty($imovel->foto_destaque) && file_exists(ROOTPATH . 'public' . $imovel->foto_destaque)) {
            unlink(ROOTPATH . 'public' . $imovel->foto_destaque);
        }

        // Busca todas as imagens do imóvel
        $imagens = $imovelImagemModel->where('id_imovel', $id)->findAll();

        // Apaga cada imagem do imóvel
        foreach ($imagens as $imagem) {
            $filePath = ROOTPATH . 'public' . $imagem->caminho_imagem;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Remove os registros das imagens do banco de dados
        $imovelImagemModel->where('id_imovel', $id)->delete();

        // Remove o imóvel do banco de dados
        if ($imoveisModel->delete($id)) {
            return $this->response->setJSON(['success' => 'Imóvel excluído com sucesso.']);
        } else {
            return $this->response->setJSON(['error' => 'Erro ao tentar excluir o imóvel.']);
        }
    }


    public function uploadImages($imovelId)
    {

        $imovelImagemModel = new ImovelImagemModel();
        $imagem = $this->request->getFile('file');

        if ($this->request->getMethod() === 'GET') {
            $imagens = $imovelImagemModel->where('id_imovel', $imovelId)->findAll();
            return $this->response->setJSON($imagens);
        }
        if ($imagem->isValid() && !$imagem->hasMoved() && $imagem->getSize() <= 5242880) { // 5MB
            $imagePath = $this->imageService->uploadAndResizeImage($imagem, "uploads/imoveis/galeria/$imovelId", 500, 500, 5242880); // 5MB
            $imovelImagemData = [
                'id_imovel' => $imovelId,
                'caminho_imagem' => $imagePath,
            ];
            $imovelImagemModel->save($imovelImagemData);
        } else {
            return $this->response->setJSON(['error' => 'Cada imagem deve ser menor que 5MB.']);
        }

        return $this->response->setJSON(['success' => true, 'id' => $imovelImagemModel->getInsertID()]);
    }

    public function deleteImage($id)
    {
        $imovelImagemModel = new ImovelImagemModel();
        $imagem = $imovelImagemModel->find($id);

        if ($imagem) {
            $filePath = ROOTPATH . 'public' . $imagem->caminho_imagem;
            if (file_exists($filePath)) {
                unlink($filePath); // Remove o arquivo físico
            }
            $imovelImagemModel->delete($id); // Remove o registro do banco de dados
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['error' => 'File not found'], 404);
    }

    private function upload()
    {

        $img = $this->request->getFile('foto_destaque');

        try {
            $imagePath = $this->imageService->uploadAndResizeImage($img, 'uploads/imoveis', 500, 500);
            // Salve o caminho da imagem no banco de dados ou faça outras operações necessárias
            // $data['imagem'] = $imagePath;
            return $imagePath;
        } catch (\RuntimeException $e) {
            return $this->response->setStatusCode(400, $e->getMessage());
        }
    }
}
