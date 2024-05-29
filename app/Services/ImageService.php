<?php namespace App\Services;

use CodeIgniter\Files\File;
use Config\Services;

class ImageService
{
    public function uploadAndResizeImage($file, $uploadDir = 'uploads/usuarios', $width = 150, $height = 150, $maxSize = 1048576)
    {
         // Verificar se um arquivo foi enviado
         if (!$file) {
            return '';
        }
        // Validação do arquivo
        if ($file->isValid() && !$file->hasMoved()) {
            // Verificar tipo de arquivo
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                throw new \RuntimeException('Tipo de arquivo não suportado. Somente PNG, JPEG e JPG são permitidos.');
            }

            // Verificar tamanho do arquivo (max 1MB)
            if ($file->getSize() > $maxSize) {
                throw new \RuntimeException('O arquivo deve ter no máximo 1MB.');
            }
            
            $this->createUploadDirectory($uploadDir); // Garante que o diretório de uploads existe
            $newName = $file->getRandomName(); // Gera um novo nome para o arquivo

            // Caminho temporário para redimensionamento
            $tempPath = WRITEPATH . 'uploads/temp/' . $newName;
            $file->move(WRITEPATH . 'uploads/temp', $newName);

            // Redimensionar a imagem para 150x150
            $image = Services::image()
                ->withFile($tempPath)
                ->fit($width, $height)
                ->save(FCPATH . $uploadDir . '/' . $newName);

            // Remover a imagem temporária
            unlink($tempPath);

            return '/' . $uploadDir . '/' . $newName; // Retorna o caminho da imagem salva
        }

        return '';
    }

    private function createUploadDirectory($path)
    {
        $fullPath = FCPATH . $path;
        if (!is_dir($fullPath)) {
            mkdir($fullPath, 0755, true); // Cria o diretório com permissões adequadas
        }
    }
}
