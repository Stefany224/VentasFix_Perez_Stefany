<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteApiController extends Controller {
     private function reglas($idIgnorar = null) {
     $uniqueRut = $idIgnorar
        ? "unique:clientes,rut_empresa,{$idIgnorar}"
        : 'unique:clientes,rut_empresa';

        return [
        'rut_empresa' => ['required', 'string', 'max:12', $uniqueRut, 'regex:/^[0-9]+-[0-9kK]{1}$/'],
        'rubro' => ['required', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
        'razon_social' => ['required', 'string', 'max:150', 'regex:/^(?=.*\pL)[\pL\d\s.,&-]+$/u'],
        'telefono' => ['required', 'string', 'regex:/^\+?[0-9\s]{7,15}$/'],
        'direccion' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+\s\d[\pL\d\s.,#-]*$/u'],
        'nombre_contacto' => ['required', 'string', 'max:150', 'regex:/^[\pL\s]+$/u'],
        'email_contacto' => ['required', 'string', 'max:255', 'regex:/^(?=[a-zA-Z0-9._%+-]*\pL)[a-zA-Z0-9][a-zA-Z0-9._%+-]*@[a-zA-Z0-9][a-zA-Z0-9-]*\.(com|cl)$/u'],
    ];
}

    private function mensajes() {
        return [
        'rut_empresa.required' => 'El rut de la empresa es obligatorio.',
        'rut_empresa.unique' => 'Este rut ya esta registrado.',
        'rut_empresa.regex' => 'El rut debe tener el formato 12345678-9.',
        'rubro.required' => 'El rubro es obligatorio.',
        'rubro.regex' => 'El rubro solo puede contener letras y espacios.',
        'razon_social.required' => 'La razon social es obligatoria.',
        'razon_social.regex' => 'La razon social debe contener al menos una letra, sin ser solo numeros o simbolos.',
        'telefono.required' => 'El telefono es obligatorio.',
        'telefono.regex' => 'El telefono debe contener solo numeros, espacios y opcionalmente un + al inicio.',
        'direccion.required' => 'La direccion es obligatoria.',
        'direccion.regex' => 'La direccion debe comenzar con el nombre de la calle seguido del numero, ej: Barsovia 112.',
        'nombre_contacto.required' => 'El nombre de contacto es obligatorio.',
        'nombre_contacto.regex' => 'El nombre de contacto solo puede contener letras y espacios.',
        'email_contacto.required' => 'El correo de contacto es obligatorio.',
        'email_contacto.regex' => 'El correo debe tener un formato valido y terminar en .com o .cl.',
    ];
}

    public function index()
    {
        $clientes = Cliente::orderBy('created_at', 'desc')->get();
        return response()->json($clientes, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->reglas(), $this->mensajes());

        $cliente = Cliente::create($validated);

        return response()->json($cliente, 201);
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        return response()->json($cliente, 200);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $validated = $request->validate($this->reglas($id), $this->mensajes());

        $cliente->update($validated);

        return response()->json($cliente, 200);
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $cliente->delete();

        return response()->noContent();
    }
}