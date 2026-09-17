@props(['id', 'rutEmpresa', 'razonSocial', 'rubro', 'telefono', 'nombreContacto', 'emailContacto'])

<div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
    <div>
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-bold text-slate-800">{{ $razonSocial }}</h3>
            <span class="bg-blue-50 text-blue-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                {{ $rutEmpresa }}
            </span>
        </div>
        <p class="text-slate-500 text-sm">Rubro: <span class="font-medium text-slate-700">{{ $rubro }}</span></p>
        <p class="text-slate-500 text-sm">Contacto: <span class="font-medium text-slate-700">{{ $nombreContacto }}</span></p>
        <p class="text-slate-500 text-sm">{{ $telefono }} — {{ $emailContacto }}</p>
    </div>
    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-end">
        <div class="flex gap-3 text-sm">
            <a href="{{ route('clientes.edit', $id) }}" class="font-medium text-amber-600 hover:underline">Editar</a>
            <form action="{{ route('clientes.destroy', $id) }}" method="POST" class="inline">
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Eliminar este cliente?')" class="font-medium text-red-600 hover:underline">Eliminar</button>
            </form>
        </div>
    </div>
</div>