<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function user()
    {
        return response()->json([
            'user' => Auth::user(),
        ], 200);
    }

    public function updateUser(Request $request)
    {
        $name = $request->only(['name']);
        $email = $request->only(['email']);
        $password = $request->only(['password']);

        $user = User::find(Auth::id());

        if ($user) {

            if ($name && $name['name']) {
                $request->validate([
                    'name' => 'required|string|min:5|max:255',
                ]);
                $user->name = ucwords($name['name']);
            }

            if ($email && $email['email'] && $email['email'] !== $user->email) {
                $request->validate([
                    'email' => 'required|string|email|min:8|max:255|unique:users',
                ], [
                    'email.unique' => 'Este e-mail já está cadastrado',
                ]);
                $user->email = $email['email'];
            }

            if ($password && $password['password']) {
                $request->validate([
                    'password' => 'required|string|min:6|max:255|same:password_confirmation',
                    'password_confirmation' => 'required|string|min:6|max:255',
                ]);
                $user->password = password_hash($password['password'], PASSWORD_DEFAULT);
            }

            $user->save();

            return response()->json([
                'message' => 'Dados atualizados com sucesso',
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'error' => 'Usuário não encontrado',
            ], 404);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logout com sucesso'], 200);
    }
}
