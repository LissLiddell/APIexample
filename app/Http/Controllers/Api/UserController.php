<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // Validar los datos del formulario de inicio de sesión
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // Intentar iniciar sesión con las credenciales proporcionadas
        if (Auth::attempt($credentials)) {
            // Si las credenciales son válidas, obtener el usuario autenticado
            $user = Auth::user();
            // Obtener el nombre de usuario del usuario autenticado
            $username = $user->name; // Cambia 'name' al nombre del campo donde está almacenado el nombre de usuario
            // Obtener el token de acceso
            $token = $user->createToken('authToken')->plainTextToken;
            // Devolver el token de acceso y el nombre de usuario en la respuesta JSON
            return response()->json(['token' => $token, 'username' => $username], 200);
        }
        // Si las credenciales no son válidas, devolver un mensaje de error
        return response()->json(['error' => 'Credenciales no válidas'], 401);
    }
}
