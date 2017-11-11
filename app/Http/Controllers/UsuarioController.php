<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\User;

class UsuarioController extends Controller
{
    /**
     * @var User
     */
    private $user;


    /**
     * UsuarioController constructor.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function list()
    {
        $usuarios = $this->user->all();
        return response()->json($usuarios);
    }

    public function get($id)
    {
        $usuario = $this->user::query()->find($id);
        if ($usuario) {
            return response()->json($usuario);
        }
        return response()->json(['message' => 'Usuário não foi encontrado'], 404);
    }

    public function delete($id)
    {
        if($this->user->destroy($id)) {
            return response()->json(['message' => 'Usuário deletado'], 200);
        }
        return response()->json(['message' => 'Usuário não foi deletado'], 400);
    }

    public function update(UpdateUserRequest $request, $id) {
        if (!$this->user::query()->find($id)) {
            return response()->json(['message' => 'Usuário não foi encontrado'], 400);
        }
        if($this->user->updateRow(new User($request->all()))) {
            return response()->json(['message' => 'Usuário editado'], 200);
        }
        return response()->json('Usuário não foi editado', 400);
    }

}

