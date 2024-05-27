<?php

namespace App\Controllers\Usuarios;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Entities\User;

class UserController extends BaseController
{
    public function index()
    {
        //
    }

    public function perfil(){
        
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url());
        }

        $id = auth()->user()->id;
        $usuarioModel = new UsuarioModel();

        $usuario = $usuarioModel->find($id);

        return view('usuarios/perfil', compact('usuario'));
    }

    public function atualizaPerfil(){

        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url());
        }

        $id = auth()->user()->id;
        $usuarioModel = new UsuarioModel();

        $usuario = $usuarioModel->find($id);

        return view('usuarios/atualizar-perfil', compact('usuario'));
    }

    public function submitAtualizaPerfil(){
        $id = auth()->user()->id;
        $usuarioModel = new UsuarioModel();
        $usuario = new User($this->request->getGetPost());

        if(!$usuarioModel->update($id, $usuario)){

        }
        return redirect()->to(base_url("usuarios/atualizar-perfil/$id"))->with('success', 'Você se candidatou à vaga');
    }
}
