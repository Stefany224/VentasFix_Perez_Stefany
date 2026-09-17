@extends('layouts.app')

@section('titulo', 'Agregar Cliente')

@section('contenido')

    <div class="max-w-2xl rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('clientes.store') }}" method="POST" class="space-y-4">
            @csrf
            <x-atoms.input-field label="Rut Empresa" name="rut_empresa" pattern="[0-9]+-[0-9kK]{1}" />
            <x-atoms.input-field label="Rubro" name="rubro" />
            <x-atoms.input-field label="Razon Social" name="razon_social" />
            <x-atoms.input-field label="Telefono" name="telefono" />
            <x-atoms.input-field label="Direccion" name="direccion" />
            <x-atoms.input-field label="Nombre de contacto" name="nombre_contacto" />
            <x-atoms.input-field label="Correo de contacto" name="email_contacto" type="email" />

            <div class="flex items-center gap-3 pt-2">
                <x-atoms.button color="blue">Guardar</x-atoms.button>
                <a href="{{ route('clientes.index') }}" class="text-sm text-gray-500 hover:underline">Cancelar</a>
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