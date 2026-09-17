<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoApiController extends Controller {
      private function reglas($idIgnorar = null) {
        $uniqueSku = $idIgnorar
        ? "unique:productos,sku,{$idIgnorar}"
        : 'unique:productos,sku';

    return [
        'sku' => ['required', 'string', 'max:50', $uniqueSku, 'regex:/^[a-zA-Z0-9]+(-[a-zA-Z0-9]+)*$/'],
        'nombre' => ['required', 'string', 'max:150', 'regex:/^(?=.*\pL)[\pL\d\s]+$/u'],
        'descripcion_corta' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
        'descripcion_larga' => ['required', 'string', 'regex:/^[\pL\s]+$/u'],
        'imagen' => ['required', 'string', 'regex:/^((https?:\/\/\S+)|([\pL][\pL\d_-]*\.(jpg|jpeg|png|gif|webp)))$/ui'],
        'precio_neto' => ['required', 'numeric', 'min:1'],
        'stock_minimo' => ['required', 'integer', 'min:0'],
        'stock_bajo' => ['required', 'integer', 'gte:stock_minimo'],
        'stock_alto' => ['required', 'integer', 'gte:stock_bajo'],
        'stock_actual' => ['required', 'integer', 'min:0'],
    ];
}

    private function mensajes() {
    return [
        'sku.required' => 'El SKU es obligatorio.',
        'sku.unique' => 'Este SKU ya esta registrado.',
        'sku.regex' => 'El SKU solo puede contener letras, numeros y guiones (no solo simbolos).',
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.regex' => 'El nombre debe contener al menos una letra, sin simbolos.',
        'descripcion_corta.required' => 'La descripcion corta es obligatoria.',
        'descripcion_corta.regex' => 'La descripcion corta solo puede contener letras y espacios.',
        'descripcion_larga.required' => 'La descripcion larga es obligatoria.',
        'descripcion_larga.regex' => 'La descripcion larga solo puede contener letras y espacios.',
        'imagen.required' => 'La imagen es obligatoria.',
        'imagen.regex' => 'La imagen debe ser un nombre de archivo valido (ej: producto1.jpg) o una URL.',
        'precio_neto.required' => 'El precio neto es obligatorio.',
        'precio_neto.min' => 'El precio neto debe ser mayor que cero.',
        'stock_minimo.required' => 'El stock minimo es obligatorio.',
        'stock_bajo.required' => 'El stock bajo es obligatorio.',
        'stock_bajo.gte' => 'El stock bajo debe ser mayor o igual al stock minimo.',
        'stock_alto.required' => 'El stock alto es obligatorio.',
        'stock_alto.gte' => 'El stock alto debe ser mayor o igual al stock bajo.',
        'stock_actual.required' => 'El stock actual es obligatorio.',
    ];
}


    public function index()
    {
        $productos = Producto::orderBy('created_at', 'desc')->get();
        return response()->json($productos, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->reglas(), $this->mensajes());

        $validated['precio_venta'] = round($validated['precio_neto'] * 1.19, 2);

        $producto = Producto::create($validated);

        return response()->json($producto, 201);
    }

    public function show($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto, 200);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $validated = $request->validate($this->reglas($id), $this->mensajes());

        $validated['precio_venta'] = round($validated['precio_neto'] * 1.19, 2);

        $producto->update($validated);

        return response()->json($producto, 200);
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $producto->delete();

        return response()->noContent();
    }
}