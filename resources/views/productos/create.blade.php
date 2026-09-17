@extends('layouts.app')

@section('titulo', 'Agregar Producto')

@section('contenido')

    <div class="max-w-2xl rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('productos.store') }}" method="POST" class="space-y-4">
            @csrf
            <x-atoms.input-field label="SKU" name="sku" />
            <x-atoms.input-field label="Nombre" name="nombre" />
            <x-atoms.input-field label="Descripción corta" name="descripcion_corta" />
            <x-atoms.input-field label="Descripción larga" name="descripcion_larga" />
            <x-atoms.input-field label="Imagen (nombre de archivo o URL)" name="imagen" />
            <x-atoms.input-field label="Precio neto" name="precio_neto" type="number" min="1" />
            <x-atoms.input-field label="Stock actual" name="stock_actual" type="number" min="0" />
            <x-atoms.input-field label="Stock mínimo" name="stock_minimo" type="number" min="0" />
            <x-atoms.input-field label="Stock bajo" name="stock_bajo" type="number" min="0" />
            <x-atoms.input-field label="Stock alto" name="stock_alto" type="number" min="0" />

            <div class="flex items-center gap-3 pt-2">
                <x-atoms.button color="blue">Guardar</x-atoms.button>
                <a href="{{ route('productos.index') }}" class="text-sm text-gray-500 hover:underline">Cancelar</a>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        protegerPagina();
    });
</script>
@endpush