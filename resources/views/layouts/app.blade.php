<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'VentasFix') | Backoffice</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-800 antialiased flex flex-col">

     <x-molecules.navbar />

    <main class="mx-auto max-w-6xl px-6 py-8 flex-grow w-full">

        @if (session('mensaje'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('mensaje') }}
            </div>
        @endif

        @hasSection('titulo')
            <div class="mb-6 flex flex-col items-start sm:flex-row sm:items-center sm:justify-between gap-3">
                <h1 class="text-2xl font-bold text-gray-800">
                    @yield('titulo')
                </h1>
                @yield('titulo-accion')
            </div>
        @endif

        @yield('contenido')

    </main>

    <footer class="mt-16 border-t border-gray-200 py-6 text-center text-xs text-gray-400 bg-white">
        VentasFix &copy; {{ date('Y') }}
    </footer>

    @stack('scripts')
</body>
</html>