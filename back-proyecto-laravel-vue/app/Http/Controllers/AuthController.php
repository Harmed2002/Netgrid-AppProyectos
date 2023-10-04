<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function funLogin(Request $request)
	{
		// Validamos
		$credenciales = $request->validate([
			"email" => "required|email",
			"password" => "required"
		]);

		// Conectamos
		if (!Auth::attempt($credenciales)) {
			return response()->json(['message' => "No autenticado"], 401);
		}

		// generamos token
		$usuario = Auth::user();
		$token = $usuario->createToken("Token personal")->plainTextToken;

		// Retornamos los datos
		return response()->json([
			"access_token" => $token,
			"type_token" => "Bearer",
			"usuario" => $usuario
		]);
	}

	public function funRegistro(Request $request)
	{
		// Validar datos
		$request->validate([
			"name" => "required",
			"email" => "required|email|unique:users",
			"password" => "required",
			"c_password" => "required|same:password"
		]);

		// Guardamos usuario
		$usuario = new User;
		$usuario->name = $request->name;
		$usuario->email = $request->email;
		$usuario->password = $request->password;
		$usuario->save();

		return response()->json(["mensaje" => "Usuario registrado"], 201);
	}

	public function funPerfil()
	{
        return Auth::user();
	}

	public function funSalir()
	{
        Auth::user()->tokens()->delete();

        return response()->json(["message" => "Salida"]);
	}
}
