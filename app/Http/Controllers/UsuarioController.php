<?php

namespace App\Http\Controllers;

use App\Repositories\UsuarioRepository;
use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * @var UsuarioRepository
     */
    private $usuarioRepository;

    /**
     * UsuarioController constructor.
     */
    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function list()
    {
        $usuarios = $this->usuarioRepository->list();
        return response()->json($usuarios);
    }

    public function get($id)
    {
        $usuario = $this->usuarioRepository->get($id);
        if ($usuario) {
            return response()->json($usuario);
        }
        return response()->json(['message' => 'Usuário não foi encontrado'], 404);
    }

    public function delete($id)
    {
        if($this->usuarioRepository->delete($id)) {
            return response()->json(['message' => 'Usuário deletado'], 200);
        }
        return response()->json(['message' => 'Usuário não foi deletado'], 400);
    }

    public function create(Request $request) {
        if ($this->usuarioRepository->create(new Usuario($request->all()))) {
            return response()->json(['message' => 'Usuário registrado'], 201);
        }
        return response()->json(['message' => 'Usuário não foi registrado'], 400);
    }

    public function update(Request $request, $id) {
        if (!$this->usuarioRepository->get($id)) {
            return response()->json(['message' => 'Usuário não foi encontrado'], 400);
        }
        if($this->usuarioRepository->update(new Usuario($request->all()))) {
            return response()->json(['message' => 'Usuário editado'], 200);
        }
        return response()->json(['message' => 'Usuário não foi editado'], 400);
    }

}

