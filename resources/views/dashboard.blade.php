@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('contenido')

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm text-center">
            <p class="text-sm font-semibold text-slate-500 uppercase mb-2">Usuarios</p>
            <p id="total-usuarios" class="text-4xl font-extrabold text-blue-600">--</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm text-center">
            <p class="text-sm font-semibold text-slate-500 uppercase mb-2">Productos</p>
            <p id="total-productos" class="text-4xl font-extrabold text-blue-600">--</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm text-center">
            <p class="text-sm font-semibold text-slate-500 uppercase mb-2">Clientes</p>
            <p id="total-clientes" class="text-4xl font-extrabold text-blue-600">--</p>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', async function () {
        protegerPagina();

        const token = localStorage.getItem('token');
        if (!token) return;

        try {
            const response = await fetch('/api/dashboard', {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                },
            });
            const data = await response.json();

            document.getElementById('total-usuarios').textContent = data.total_usuarios;
            document.getElementById('total-productos').textContent = data.total_productos;
            document.getElementById('total-clientes').textContent = data.total_clientes;
        } catch (error) {
            console.error('No se pudo cargar el dashboard', error);
        }
    });
</script>
@endpush