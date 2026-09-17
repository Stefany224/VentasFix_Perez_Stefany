@extends('layouts.app')

@section('titulo', 'Listado de Clientes')

@section('titulo-accion')
    <a href="{{ route('clientes.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 whitespace-nowrap">
        + Agregar Cliente
    </a>
@endsection

@section('contenido')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
        @forelse ($clientes as $c)
            <x-molecules.cliente-card
                :id="$c->id"
                :rutEmpresa="$c->rut_empresa"
                :razonSocial="$c->razon_social"
                :rubro="$c->rubro"
                :telefono="$c->telefono"
                :nombreContacto="$c->nombre_contacto"
                :emailContacto="$c->email_contacto"
            />
        @empty
            <div class="col-span-full text-center py-12 text-slate-400">
                Aún no hay clientes registrados.
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