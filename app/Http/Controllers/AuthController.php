<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($data)) {
            $user = Auth::user();
            $obj['id'] = $user->id;
            $obj['name'] = $user->name;
            $obj['email'] = $user->email;

            return response()->json([
                'token' => $user->createToken('PassportAuth')->accessToken,
                'user' => $obj,
                'message' => 'Bienvenido',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'error' => 'Unauthorised',
                'message' => 'Credenciales incorrectas',
                'status' => 500,
            ], 401);
        }
    }
}
