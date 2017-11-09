<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function users(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user('api')->token()->revoke();

        return response([
            'message' => 'Usuário foi deslogado com sucesso'
        ]);
    }

    public function mudarSenha(Request $request) {

    }
}
