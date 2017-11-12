<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\StoreUserRequest;

class RegisterController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $user = new User($request->all());
        if ($user->save(['master' => true])) {
            return response('Usuário registrado com sucesso', 200);
        }
        return response('Não foi possível registrar usuário', 400);
    }

}
