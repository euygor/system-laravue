<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $auth = $request->only(['email', 'password']);

        $token = Auth::attempt($auth);

        if ($token) {
            return response()->json([
                'user' => Auth::user(),
                'token' => $token,
            ], 200);
        } else {
            return response()->json([
                'message' => 'E-mail ou senha inválidos',
            ], 401);
        }
    }
}
