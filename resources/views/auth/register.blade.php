@extends('layouts.app')

@section('contenido')

    <x-molecules.auth-card
        titulo="Registrarse"
        subtitulo="Crea tu cuenta de acceso al backoffice"
    >
        <x-atoms.error-box />

        <form id="form-register" class="space-y-4">
            <x-atoms.input-field label="Rut" name="rut" type="text" pattern="[0-9]+-[0-9kK]{1}" />
            <x-atoms.input-field label="Nombre" name="nombre" type="text" />
            <x-atoms.input-field label="Apellido" name="apellido" type="text" />
            <x-atoms.input-field label="Correo" name="email" type="email" />
            <x-atoms.input-field label="Contraseña" name="password" type="password" pattern=".*[\p{L}\d].*" />

            <div class="pt-2">
                <x-atoms.button color="blue" class="w-full">
                    Crear Cuenta
                </x-atoms.button>
            </div>
        </form>

        <p class="text-center text-sm text-slate-500 mt-6">
            ¿Ya tienes cuenta?
            <a href="{{ route('login.view') }}" class="text-blue-600 font-semibold hover:underline">Inicia sesión</a>
        </p>

    </x-molecules.auth-card>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        enviarFormularioAuth('form-register', '/api/register', () => {
            window.location.href = '{{ route('login.view') }}';
        });
    });
</script>
@endpush