<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\ImoveisModel;
use App\Models\ImovelImagemModel;
use App\Services\ImageService;
use CodeIgniter\HTTP\ResponseInterface;

class AdminImoveisController extends BaseController
{
    protected $imageService;
    public function __construct()
    {
        $this->imageService = new ImageService();
    }
    public function index()
    {
        //
    }
    public function listarImovel()
    {
        //
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
              if($imgCarregada != ''){
                  $imovel['foto_destaque'] = $imgCarregada;
              }
                 
            $imovelModel = new ImoveisModel();

            if (!$imovelModel->insertImovel($imovel)) {
                return redirect()->back()->with('error', 'Não Foi possível cadastrat a vaga.')->withInput();
            }

            return redirect()->to(base_url('admin/imoveis/listar'))->with('success', 'Vaga cadastrada com sucesso!.');
        }

        $dados = [
            'empresas' => $adminModel->where('id_grupo', 3)->findAll(),
            'title' => 'Cadastrar Imóvel'
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
            $data = $this->request->getGetPost();

            if ($imoveisModel->update($id, $data)) {
                return redirect()->to('/admin/vagas/listar')->with('success', 'Vaga atualizada com sucesso.');
            } else {
                return redirect()->back()->with('error', 'Erro ao tentar atualizar a vaga.');
            }
        }
        $imovelImagem = $imovelImagemModel->where('id_imovel', $id)->findAll();
  
        // Mostrar o formulário com os dados existentes
        return view('admin/imoveis/cadastrar_editar', [
            'empresas' => $adminModel->where('id_grupo', 3)->findAll(),
            'imagens' => $imovelImagem,
            'uploadUrl' => base_url("admin/imovel/uploadImages/{$id}"),
            'deleteUploadUrl' => base_url("admin/imovel/deleteImage/"),
            'title' => 'Alterar imóvel',
            'imovel' => $imovel,
            'jsFiles' => [
                base_url('assets/admin/js/imoveis.js')
            ]
        ]);
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
                'caminho_imagem' => '/uploads/imoveis/' . $imagem->getName(),
            ];
            $imovelImagemModel->save($imovelImagemData);
        } else {
            return $this->response->setJSON(['error' => 'Cada imagem deve ser menor que 5MB.']);
        }

        return $this->response->setJSON(['success' => true]);
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
