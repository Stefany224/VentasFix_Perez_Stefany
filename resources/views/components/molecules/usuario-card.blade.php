@props(['id', 'rut', 'nombre', 'apellido', 'email'])

<div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
    <div>
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-bold text-slate-800">{{ $nombre }} {{ $apellido }}</h3>
            <span class="bg-blue-50 text-blue-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                {{ $rut }}
            </span>
        </div>
        <p class="text-slate-500 text-sm">{{ $email }}</p>
    </div>
    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-end">
        <div class="flex gap-3 text-sm">
            <a href="{{ route('usuarios.edit', $id) }}" class="font-medium text-amber-600 hover:underline">Editar</a>
            <form action="{{ route('usuarios.destroy', $id) }}" method="POST" class="inline">
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Eliminar este usuario?')" class="font-medium text-red-600 hover:underline">Eliminar</button>
            </form>
        </div>
    </div>
</div>