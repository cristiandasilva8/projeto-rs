<?php namespace App\Controllers;

use CodeIgniter\Controller;

class ImagemController extends Controller
{
    public function getUserImage($filename)
    {
        log_message('debug', 'Chamando getUserImage com filename: ' . $filename);
        die("Chamando getUserImage com filename: " . $filename);

        $path = WRITEPATH . 'uploads/users/' . $filename;

        if (file_exists($path)) {
            $mime = mime_content_type($path);
            header('Content-Length: ' . filesize($path));
            header("Content-Type: $mime");
            readfile($path);
            exit;
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Imagem não encontrada');
        }
    }
    public function upload($img)
    {

        // Validação do arquivo
        if ($img && $img->isValid() && !$img->hasMoved()) {
            // Verificar tipo de arquivo
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($img->getMimeType(), $allowedTypes)) {
                return $this->response->setStatusCode(400, 'Tipo de arquivo não suportado. Somente PNG, JPEG e JPG são permitidos.');
            }

            // Verificar tamanho do arquivo (max 1MB)
            if ($img->getSize() > 1048576) {
                return $this->response->setStatusCode(400, 'O arquivo deve ter no máximo 1MB.');
            }

            $this->createUploadDirectory(); // Garante que o diretório de uploads existe
            $newName = $img->getRandomName(); // Gera um novo nome para o arquivo

            // Caminho temporário para redimensionamento
            $tempPath = WRITEPATH . 'uploads/temp/' . $newName;
            $img->move(WRITEPATH . 'uploads/temp', $newName);

            // Redimensionar a imagem para 150x150
            $image = \Config\Services::image()
                ->withFile($tempPath)
                ->fit(150, 150)
                ->save(FCPATH . 'uploads/usuarios/' . $newName);

            // Remover a imagem temporária
            unlink($tempPath);

            $data['imagem'] = '/uploads/usuarios/' . $newName; // Caminho da imagem salva
            // Salve o caminho no banco de dados ou faça outras operações necessárias

            return $this->response->setJSON(['message' => 'Upload bem-sucedido', 'imagem' => $data['imagem']]);
        }

        return $this->response->setStatusCode(400, 'Nenhum arquivo enviado ou arquivo inválido.');
    }

    private function createUploadDirectory()
    {
        $path = FCPATH . 'uploads/usuarios';
        if (!is_dir($path)) {
            mkdir($path, 0755, true); // Cria o diretório com permissões adequadas
        }
    }
}
