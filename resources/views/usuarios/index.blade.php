@extends('layouts.app')

@section('titulo', 'Listado de Usuarios')

@section('contenido')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
        @forelse ($usuarios as $u)
            <x-molecules.usuario-card
                :id="$u->id"
                :rut="$u->rut"
                :nombre="$u->nombre"
                :apellido="$u->apellido"
                :email="$u->email"
            />
        @empty
            <div class="col-span-full text-center py-12 text-slate-400">
                Aun no hay usuarios registrados.
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