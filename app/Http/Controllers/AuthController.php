<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @var User
     */
    private $user;


    /**
     * AuthController constructor.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

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

    public function changePassword(ChangePasswordRequest $request) {
        if (!Hash::check($request['old_password'], Auth::user()->getAuthPassword()) ) {
            return response()->json("Senha antiga incorreta!", 400);
        }
        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();
        return response()->json(['message' => 'Senha alterada!'], 200);
    }
}
