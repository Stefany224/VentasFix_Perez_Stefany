@props(['id', 'sku', 'nombre', 'precioNeto', 'precioVenta', 'stockActual', 'stockMinimo', 'stockBajo', 'stockAlto'])

<div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
    <div>
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-bold text-slate-800">{{ $nombre }}</h3>
            <span class="bg-blue-50 text-blue-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                {{ $sku }}
            </span>
        </div>
        <p class="text-slate-500 text-sm">Precio neto: <span class="font-medium text-slate-700">${{ number_format($precioNeto, 0, ',', '.') }}</span></p>
        <p class="text-slate-500 text-sm">Precio venta (IVA incl.): <span class="font-medium text-slate-700">${{ number_format($precioVenta, 0, ',', '.') }}</span></p>
        <p class="text-slate-500 text-sm mt-1">
            Stock actual:
            <span class="font-bold {{ $stockActual <= $stockBajo ? 'text-red-600' : 'text-slate-700' }}">
                {{ $stockActual }}
            </span>
        </p>
    </div>
    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
        <span class="text-xs font-semibold text-slate-400">Stock min-max: {{ $stockMinimo }} / {{ $stockAlto }}</span>
        <div class="flex gap-3 text-sm">
            <a href="{{ route('productos.edit', $id) }}" class="font-medium text-amber-600 hover:underline">Editar</a>
            <form action="{{ route('productos.destroy', $id) }}" method="POST" class="inline">
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Eliminar este producto?')" class="font-medium text-red-600 hover:underline">Eliminar</button>
            </form>
        </div>
    </div>
</div>