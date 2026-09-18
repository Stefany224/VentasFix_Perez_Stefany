<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioApiController extends Controller {
     private function reglas($idIgnorar) {
        return [
            'rut' => ['required', 'string', 'max:12', "unique:usuarios,rut,{$idIgnorar}", 'regex:/^[0-9]+-[0-9kK]{1}$/'],
            'nombre' => ['required', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'apellido' => ['required', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'string', 'max:255', 'unique:usuarios,email', 'regex:/^(?=[a-zA-Z0-9._%+-]*\pL)[a-zA-Z0-9][a-zA-Z0-9._%+-]*@ventasfix\.cl$/u'],
            'password' => ['required', 'string', 'min:8', 'regex:/[\pL\d]/u'],
        ];
    }

    private function mensajes() {
        return [
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
        ];
    }

    public function index()
    {
        $usuarios = Usuario::orderBy('created_at', 'desc')->get();
        return response()->json($usuarios, 200);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($usuario, 200);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validated = $request->validate($this->reglas($id), $this->mensajes());

        $validated['password'] = Hash::make($validated['password']);

        $usuario->update($validated);

        return response()->json($usuario, 200);
    }

    public function destroy($id) {
        $usuario = Usuario::findOrFail($id);

        if ((int) $id === (int) auth('api')->id()) {
            return response()->json(['message' => 'No puedes eliminar tu propio usuario.'], 403);
        }

        $usuario->delete();

        return response()->noContent();
    }
}