@extends('layouts.app')

@section('titulo', 'Editar Cliente')

@section('contenido')

    <div class="max-w-2xl rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <x-atoms.input-field label="Rut Empresa" name="rut_empresa" pattern="[0-9]+-[0-9kK]{1}" :value="$cliente->rut_empresa" />
            <x-atoms.input-field label="Rubro" name="rubro" :value="$cliente->rubro" />
            <x-atoms.input-field label="Razon Social" name="razon_social" :value="$cliente->razon_social" />
            <x-atoms.input-field label="Telefono" name="telefono" :value="$cliente->telefono" />
            <x-atoms.input-field label="Direccion" name="direccion" :value="$cliente->direccion" />
            <x-atoms.input-field label="Nombre de contacto" name="nombre_contacto" :value="$cliente->nombre_contacto" />
            <x-atoms.input-field label="Correo de contacto" name="email_contacto" type="email" :value="$cliente->email_contacto" />

            <div class="flex items-center gap-3 pt-2">
                <x-atoms.button color="amber">Actualizar</x-atoms.button>
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