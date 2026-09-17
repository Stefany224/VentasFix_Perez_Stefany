@extends('layouts.app')

@section('titulo', 'Listado de Productos')

@section('titulo-accion')
    <a href="{{ route('productos.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 whitespace-nowrap">
        + Agregar Producto
    </a>
@endsection

@section('contenido')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
        @forelse ($productos as $p)
            <x-molecules.producto-card
                :id="$p->id"
                :sku="$p->sku"
                :nombre="$p->nombre"
                :precioNeto="$p->precio_neto"
                :precioVenta="$p->precio_venta"
                :stockActual="$p->stock_actual"
                :stockMinimo="$p->stock_minimo"
                :stockBajo="$p->stock_bajo"
                :stockAlto="$p->stock_alto" />
        @empty
            <div class="col-span-full text-center py-12 text-slate-400">
                Aún no hay productos registrados.
            </div>
        @endforelse
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        protegerPagina();
    });
</script>
@endpush