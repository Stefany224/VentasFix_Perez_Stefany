@extends('layouts.app')

@section('contenido')

    <div class="min-h-[70vh] flex items-center justify-center">

        <div class="bg-white border-2 border-slate-900 rounded-2xl px-14 py-12 max-w-lg w-full mx-4 text-center shadow-lg">

            <h1 class="text-3xl font-extrabold text-slate-900 mb-4 tracking-tight">
                Ventas<span class="text-blue-600 italic">Fix</span> Backoffice
            </h1>

            <p class="text-slate-500 mb-10 leading-relaxed">
                Sistema de gestion de usuarios, productos y clientes
            </p>

            <div class="flex justify-center gap-5">
                <a href="{{ route('login.view') }}"
                    class="border-2 border-slate-900 text-slate-900 font-bold py-3 px-8 rounded-lg hover:bg-slate-900 hover:text-white transition duration-200" >
                    Iniciar Sesion
                </a>

                <a href="{{ route('register.view') }}"
                    class="border-2 border-slate-900 text-slate-900 font-bold py-3 px-8 rounded-lg hover:bg-slate-900 hover:text-white transition duration-200" >
                    Registrarse
                </a>
            </div>

        </div>

    </div>

    @push('scripts')
    <script>
        if (localStorage.getItem('token')) {
        window.location.href = '/dashboard';
        }
    </script>
@endpush

@endsection