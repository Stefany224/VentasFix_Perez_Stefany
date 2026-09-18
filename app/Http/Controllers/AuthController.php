<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {

    // registro de un usuario nuevo con la clave cifrada antes de guardarla
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'rut' => ['required', 'string', 'max:12', 'unique:usuarios,rut', 'regex:/^[0-9]+-[0-9kK]{1}$/'],
            'nombre' => 'required|string|max:100|regex:/^[\pL\s]+$/u',
            'apellido' => 'required|string|max:100|regex:/^[\pL\s]+$/u',
            'email' => ['required', 'string', 'max:255', 'unique:usuarios,email', 'regex:/^(?=[a-zA-Z0-9._%+-]*\pL)[a-zA-Z0-9][a-zA-Z0-9._%+-]*@ventasfix\.cl$/u'],
            'password' => ['required', 'string', 'min:8', 'regex:/[\pL\d]/u'],
        ], [
            'rut.required' => 'El rut es obligatorio.',
            'rut.unique' => 'Este rut ya esta registrado.',
            'rut.regex' => 'El rut debe tener el formato 12345678-9.',
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.required' => 'El correo es obligatorio.',
            'email.unique' => 'Este correo ya esta registrado.',
            'email.regex' => 'El formato del correo es erroneo y el dominio debe ser @ventasfix.cl.',
            'password.required' => 'La clave es obligatoria.',
            'password.min' => 'La clave debe tener al menos 8 caracteres.',
            'password.regex' => 'La clave no puede contener solo simbolos.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $usuario = Usuario::create([
            'rut' => $request->rut,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'usuario' => $usuario,
        ], 201);
    }

    // Funcion login para validar credenciales y devuelve  JWT si son correctas
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Debe ingresar un correo valido.',
            'password.required' => 'La clave es obligatoria.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth('api')->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        return response()->json([
            'message' => 'Login exitoso',
            'token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    // funcion logout para cerrar la sesion invalidando el token 
    public function logout(Request $request)
    {
        auth('api')->logout();

        return response()->json([
            'message' => 'Sesion cerrada correctamente',
        ]);
    }
}