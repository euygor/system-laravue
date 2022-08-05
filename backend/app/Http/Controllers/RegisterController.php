<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $dados = $request->only(['name', 'email', 'password']);

        $user = User::create([
            'name' => ucwords($dados['name']),
            'email' => $dados['email'],
            'password' => password_hash($dados['password'], PASSWORD_DEFAULT),
        ]);

        return response()->json([
            'message' => 'Usuário criado com sucesso',
            'user' => $user,
        ], 201);
    }
}
