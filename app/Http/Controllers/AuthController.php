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
}
