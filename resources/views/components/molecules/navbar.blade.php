<nav class="border-b border-gray-200 bg-white">
    <div class="mx-auto max-w-6xl px-6 py-4">
        <div class="flex items-center justify-between">

            <span class="text-lg font-bold text-gray-800">
                Ventas<span class="text-blue-600">Fix</span>
            </span>

            <div id="nav-derecha" class="items-center gap-6">
                <a href="{{ route('inicio') }}" id="link-inicio"
                   class="inline-block text-base font-semibold text-gray-600 hover:text-blue-600 transition duration-200">
                    Inicio
                </a>

                <div id="nav-modulos" class="hidden items-center gap-6">
                    <a href="{{ route('productos.index') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition duration-200">Productos</a>
                    <a href="{{ route('clientes.index') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition duration-200">Clientes</a>
                    <a href="{{ route('usuarios.index') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition duration-200">Usuarios</a>
                </div>

                <button id="btn-logout-desktop"
                    class="hidden text-red-600 hover:text-red-700 transition duration-200" title="Cerrar sesión">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                    </svg>
                </button>
            </div>

            <button id="btn-hamburguesa" class="hidden text-gray-600 hover:text-blue-600 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

        </div>

        <div id="menu-movil" class="hidden flex-col items-center gap-1 border-t border-gray-200 mt-4 pt-4">
            <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2 font-bold text-blue-800 bg-blue-50 w-full text-center">Inicio</a>
            <a href="{{ route('productos.index') }}" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50 w-full text-center">Productos</a>
            <a href="{{ route('clientes.index') }}" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50 w-full text-center">Clientes</a>
            <a href="{{ route('usuarios.index') }}" class="rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-50 w-full text-center">Usuarios</a>
            <button id="btn-logout-movil" class="flex items-center justify-center gap-2 rounded-lg px-3 py-2 font-semibold text-red-600 hover:bg-red-50 mt-2 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                </svg>
                Cerrar sesión
            </button>
        </div>
    </div>
</nav>