<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Cliente;

class DashboardApiController extends Controller {
    public function index() {
        return response()->json([
            'total_usuarios' => Usuario::count(),
            'total_productos' => Producto::count(),
            'total_clientes' => Cliente::count(),
        ], 200);
    }
}
