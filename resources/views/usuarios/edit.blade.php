@extends('layouts.app')

@section('titulo', 'Editar Usuario')

@section('contenido')

    <div class="max-w-2xl rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <x-atoms.input-field label="Rut" name="rut" pattern="[0-9]+-[0-9kK]{1}" :value="$usuario->rut" />
            <x-atoms.input-field label="Nombre" name="nombre" :value="$usuario->nombre" />
            <x-atoms.input-field label="Apellido" name="apellido" :value="$usuario->apellido" />
            <x-atoms.input-field label="Correo" name="email" type="email" :value="$usuario->email" />
            <x-atoms.input-field label="Contraseña" name="password" type="password" pattern=".*[\p{L}\d].*" />

            <div class="flex items-center gap-3 pt-2">
                <x-atoms.button color="amber">Actualizar</x-atoms.button>
                <a href="{{ route('usuarios.index') }}" class="text-sm text-gray-500 hover:underline">Cancelar</a>
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