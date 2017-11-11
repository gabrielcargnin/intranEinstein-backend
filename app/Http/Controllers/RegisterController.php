<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\StoreUserRequest;

class RegisterController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $user = new User;
        $user->nome = $request->nome;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->cpf = $request->cpf;
        if ($user->save()) {
            return response('Usuário registrado com sucesso', 200);
        }
        return response('Não foi possível registrar usuário', 400);
    }

}
